<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use App\Models\Barang; // Wajib dipanggil buat ngecek dan motong stok
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
        $keranjangUtama = session('keranjang');

        $selectedIds = explode(',', $request->selected_items);

        if (empty($keranjangUtama) || empty($selectedIds) || $selectedIds[0] == '') {
            return redirect()->route('pelanggan.keranjang.index')->with('error', 'Pilih minimal satu barang dulu bre buat dicheckout!');
        }

        $keranjangCheckout = [];
        $totalHarga = 0;

        foreach ($selectedIds as $id) {
            if (isset($keranjangUtama[$id])) {

                // --- PENJAGA PINTU: CEK STOK REAL-TIME SEBELUM CHECKOUT ---
                $cekBarang = Barang::find($id);
                if (!$cekBarang || $cekBarang->stok <= 0) {
                    return redirect()->route('pelanggan.keranjang.index')->with('error', "Waduh bre, alat {$keranjangUtama[$id]['nama']} barusan aja ludes disewa orang! Batalin centangnya dulu ya.");
                }
                // ----------------------------------------------------------

                $keranjangCheckout[$id] = $keranjangUtama[$id];
                $totalHarga += $keranjangUtama[$id]['harga_sewa'] * $keranjangUtama[$id]['lama_sewa'];
            }
        }

        // 3. Simpan Transaksi Induk ke Tabel 'penyewaans'
        $penyewaan = new Penyewaan();
        $penyewaan->user_id = Auth::id();
        $penyewaan->kode_transaksi = 'LNS-' . date('YmdHis') . '-' . Auth::id();
        $penyewaan->tanggal_mulai = date('Y-m-d');

        // Ambil durasi dari barang pertama yang di-checkout
        $durasiPertama = current($keranjangCheckout)['lama_sewa'];
        $penyewaan->tanggal_selesai = date('Y-m-d', strtotime("+$durasiPertama days"));

        $penyewaan->total_harga = $totalHarga;
        $penyewaan->status = 'Unpaid';
        $penyewaan->save();

        // 4. Simpan Detail Barang ke Tabel 'detail_penyewaans'
        foreach ($keranjangCheckout as $item) {
            $detail = new DetailPenyewaan();
            $detail->penyewaan_id = $penyewaan->id;
            $detail->barang_id = $item['id'];
            $detail->lama_sewa = $item['lama_sewa'];
            $detail->harga_satuan = $item['harga_sewa'];
            $detail->subtotal = $item['harga_sewa'] * $item['lama_sewa'];
            $detail->save();
        }

        // 5. Setup Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id' => $penyewaan->kode_transaksi,
                'gross_amount' => $totalHarga,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => '081234567890',
            ],
        ];

        // 6. Tembak ke Midtrans dan Ambil Tokennya
        try {
            $snapToken = Snap::getSnapToken($params);

            $penyewaan->snap_token = $snapToken;
            $penyewaan->save();

            // 7. BERSIHKAN KERANJANG (Tapi HANYA hapus barang yang barusan dicheckout)
            foreach ($selectedIds as $id) {
                unset($keranjangUtama[$id]);
            }
            session()->put('keranjang', $keranjangUtama); // Simpan sisa barang yang nggak ikut dicheckout

            return view('pelanggan.bayar', compact('snapToken', 'penyewaan'));
        } catch (\Exception $e) {
            $penyewaan->delete();
            return back()->with('error', 'Gagal memproses pembayaran ke Midtrans: ' . $e->getMessage());
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
                $penyewaan = Penyewaan::with('detail_penyewaan')->where('kode_transaksi', $request->order_id)->first();

                // 4. Ubah statusnya jadi 'Paid' dan KURANGI STOK (Hanya kalau sebelumnya Unpaid biar gak dobel)
                if ($penyewaan && $penyewaan->status == 'Unpaid') {
                    $penyewaan->status = 'Paid';
                    $penyewaan->save();

                    // --- STOK LANGSUNG DIKURANGI SAAT LUNAS ---
                    foreach ($penyewaan->detail_penyewaan as $detail) {
                        $barang = Barang::find($detail->barang_id);
                        if ($barang && $barang->stok > 0) {
                            $barang->decrement('stok', 1);
                        }
                    }
                }
            }
        }

        // Beri tahu server Midtrans bahwa web kita sudah menerima notifikasinya
        return response()->json(['message' => 'Callback received from Lenscape']);
    }

    /**
     * FUNGSI UPDATE STATUS DARI FRONTEND (AJAX)
     * Dipanggil pas popup Midtrans memunculkan onSuccess biar gak nyangkut Unpaid di localhost
     */
    public function paymentSuccess(Request $request, $id)
    {
        $penyewaan = Penyewaan::with('detail_penyewaan')->findOrFail($id);

        if ($penyewaan->status == 'Unpaid') {
            $penyewaan->status = 'Paid';
            $penyewaan->save();

            // --- STOK LANGSUNG DIKURANGI SAAT LUNAS ---
            foreach ($penyewaan->detail_penyewaan as $detail) {
                $barang = Barang::find($detail->barang_id);
                if ($barang && $barang->stok > 0) {
                    $barang->decrement('stok', 1);
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Status pembayaran berhasil diupdate jadi Paid dan Stok otomatis terpotong!'
        ]);
    }
}
