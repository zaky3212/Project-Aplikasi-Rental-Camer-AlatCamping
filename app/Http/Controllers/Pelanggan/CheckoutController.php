<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    /**
     * Memproses keranjang, menyimpannya ke database, dan meminta Snap Token dari Midtrans
     */
    public function prosesCheckout(Request $request)
    {
        $keranjang = session('keranjang');

        // 1. Validasi Keranjang Kosong
        if (empty($keranjang)) {
            return redirect()->route('pelanggan.keranjang.index')->with('error', 'Keranjang lu masih kosong bre!');
        }

        // 2. Hitung Total Harga Sewa
        $totalHarga = 0;
        foreach ($keranjang as $item) {
            $totalHarga += $item['harga_sewa'] * $item['lama_sewa'];
        }

        // 3. Simpan Transaksi Induk ke Tabel 'penyewaans'
        $penyewaan = new Penyewaan();
        $penyewaan->user_id = Auth::id();
        // Bikin kode transaksi unik (LNS = Lenscape, + Tanggal + ID User)
        $penyewaan->kode_transaksi = 'LNS-' . date('YmdHis') . '-' . Auth::id();
        $penyewaan->tanggal_mulai = date('Y-m-d');

        // Asumsi durasi sewa diambil dari item pertama di keranjang
        $durasiPertama = current($keranjang)['lama_sewa'];
        $penyewaan->tanggal_selesai = date('Y-m-d', strtotime("+$durasiPertama days"));

        $penyewaan->total_harga = $totalHarga;
        $penyewaan->status = 'Unpaid'; // Status awal sebelum dibayar
        $penyewaan->save();

        // 4. Simpan Detail Barang ke Tabel 'detail_penyewaans'
        foreach ($keranjang as $item) {
            $detail = new DetailPenyewaan();
            $detail->penyewaan_id = $penyewaan->id;
            $detail->barang_id = $item['id'];
            $detail->lama_sewa = $item['lama_sewa'];
            $detail->harga_satuan = $item['harga_sewa'];
            $detail->subtotal = $item['harga_sewa'] * $item['lama_sewa'];
            $detail->save();
        }

        // 5. Setup Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // 6. Susun Parameter Buat Dikirim ke Server Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $penyewaan->kode_transaksi,
                'gross_amount' => $totalHarga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '081234567890', // Bisa diganti kalau ada kolom no_hp di database
            ],
        ];

        // 7. Tembak ke Midtrans dan Ambil Tokennya
        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan token ke database buat histori
            $penyewaan->snap_token = $snapToken;
            $penyewaan->save();

            // Bersihkan keranjang karena udah pindah ke checkout
            session()->forget('keranjang');

            // Arahkan pelanggan ke halaman pembayaran (bawa Token dan Data Transaksi)
            return view('pelanggan.bayar', compact('snapToken', 'penyewaan'));
        } catch (\Exception $e) {
            // Kalau gagal (misal server down/kunci salah), hapus transaksi yang barusan dibuat biar gak nyampah
            $penyewaan->delete();
            return back()->with('error', 'Waduh, gagal memproses pembayaran ke Midtrans: ' . $e->getMessage());
        }
    }

    /**
     * FUNGSI CALLBACK
     * Menangani notifikasi otomatis dari Midtrans setelah pelanggan selesai membayar
     */
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');

        // 1. Validasi Keamanan (Signature Key) dari Midtrans
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            // 2. Cek apakah status transaksinya berhasil (capture / settlement)
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {

                // 3. Cari transaksi di database berdasarkan kode_transaksi (order_id)
                $penyewaan = Penyewaan::where('kode_transaksi', $request->order_id)->first();

                // 4. Ubah statusnya jadi 'Paid'
                if ($penyewaan) {
                    $penyewaan->status = 'Paid';
                    $penyewaan->save();
                }
            }
        }

        // Beri tahu server Midtrans bahwa web kita sudah menerima notifikasinya
        return response()->json(['message' => 'Callback received from Lenscape']);
    }
}
