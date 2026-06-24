<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyewaan;
use App\Models\Barang;
use Carbon\Carbon;

class PenyewaanController extends Controller
{
    public function index(Request $request)
    {
        $penyewaanAktif = Penyewaan::where('status', 'Disewa')->get();

        foreach ($penyewaanAktif as $p) {
            $tglSelesai = Carbon::parse($p->tanggal_selesai)->startOfDay();
            $hariIni = Carbon::now()->startOfDay();

            if ($hariIni->greaterThan($tglSelesai)) {
                $selisihHari = $tglSelesai->diffInDays($hariIni);

                $tarifDenda = 50000;

                $p->denda = $selisihHari * $tarifDenda;
                $p->alasan_denda = "Telat mengembalikan alat selama {$selisihHari} hari.";
                $p->save(); 
            } else {

            $p->denda = 0;
                $p->alasan_denda = null;
                $p->save();
            }
        }

        $query = Penyewaan::with(['user', 'detail_penyewaan.barang'])->latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('kode_transaksi', 'like', "%{$search}%");
        }

        $penyewaans = $query->get();

        return view('admin.penyewaan.index', compact('penyewaans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $penyewaan = Penyewaan::with('detail_penyewaan')->findOrFail($id);
        $statusBaru = $request->status;

        if ($statusBaru == 'Disewa' && $penyewaan->status == 'Paid') {
            foreach ($penyewaan->detail_penyewaan as $detail) {
                $barang = Barang::find($detail->barang_id);
                if ($barang && $barang->stok > 0) {
                    $barang->decrement('stok', 1);
                }
            }
        }

        if ($statusBaru == 'Selesai' && $penyewaan->status == 'Disewa') {
            foreach ($penyewaan->detail_penyewaan as $detail) {
                $barang = Barang::find($detail->barang_id);
                if ($barang) {
                    $barang->increment('stok', 1);
                }
            }
        }

        $penyewaan->status = $statusBaru;
        $penyewaan->save();

        if ($penyewaan->denda > 0) {
            return redirect()->route('admin.penyewaan.index')->with('success', 'Alat berhasil dikembalikan! Catatan: Pelanggan wajib membayar denda keterlambatan sebesar Rp ' . number_format($penyewaan->denda, 0, ',', '.') . '!');
        }

        return redirect()->route('admin.penyewaan.index')->with('success', 'Status transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Penyewaan::findOrFail($id)->delete();
        return redirect()->route('admin.penyewaan.index')->with('success', 'Data transaksi berhasil dihapus.');
    }
}
