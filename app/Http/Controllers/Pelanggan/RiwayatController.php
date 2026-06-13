<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $penyewaans = Penyewaan::where('user_id', Auth::id())
                        ->latest()
                        ->get();

        return view('pelanggan.sewa.RiwayatSewa', compact('penyewaans'));
    }

    public function show($id)
    {
        // PENTING: Gunakan with('detail_penyewaan.barang')
        // Ini memastikan Laravel mengambil data barang sekaligus, 
        // sehingga foto barang bisa muncul di view.
        $penyewaan = Penyewaan::with('detail_penyewaan.barang')
                        ->where('id', $id)
                        ->where('user_id', Auth::id())
                        ->firstOrFail();

        return view('pelanggan.sewa.DetailRiwayat', compact('penyewaan'));
    }
}