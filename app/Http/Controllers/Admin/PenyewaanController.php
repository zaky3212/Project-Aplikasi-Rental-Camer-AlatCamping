<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penyewaan;
use App\Models\DetailPenyewaan;
use App\Models\Barang;

class PenyewaanController extends Controller
{
    // Nampilin semua transaksi dari database
    public function index(Request $request)
    {
        $query = Penyewaan::with(['user', 'detail_penyewaan.barang'])->latest();

        // Fitur pencarian nama penyewa atau kode transaksi
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('kode_transaksi', 'like', "%{$search}%");
        }

        $penyewaans = $query->get();

        return view('admin.penyewaan.index', compact('penyewaans'));
    }

    // Fungsi sakti buat ngubah status dan ngatur stok barang
    public function updateStatus(Request $request, $id)
    {
        $penyewaan = Penyewaan::with('detail_penyewaan')->findOrFail($id);
        $statusBaru = $request->status;

        // 1. Kalau barang diserahkan ke pelanggan -> STOK BERKURANG
        if ($statusBaru == 'Disewa' && $penyewaan->status == 'Paid') {
            foreach ($penyewaan->detail_penyewaan as $detail) {
                $barang = Barang::find($detail->barang_id);
                if ($barang && $barang->stok > 0) {
                    $barang->decrement('stok', 1); // Kurangi 1 stok per item
                }
            }
        }

        // 2. Kalau barang dikembalikan -> STOK BERTAMBAH
        if ($statusBaru == 'Selesai' && $penyewaan->status == 'Disewa') {
            foreach ($penyewaan->detail_penyewaan as $detail) {
                $barang = Barang::find($detail->barang_id);
                if ($barang) {
                    $barang->increment('stok', 1); // Balikin 1 stok per item
                }
            }
        }

        // Update status di database
        $penyewaan->status = $statusBaru;
        $penyewaan->save();

        return redirect()->route('admin.penyewaan.index')->with('success', 'Status transaksi berhasil diupdate dan stok sudah disesuaikan!');
    }

    public function show($id)
    {
        $penyewaan = Penyewaan::with([
            'user',
            'detail_penyewaan.barang'
        ])->findOrFail($id);

        return view('admin.penyewaan.detail', compact('penyewaan'));
    }
}