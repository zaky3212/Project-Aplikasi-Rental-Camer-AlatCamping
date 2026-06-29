<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;

class RiwayatSewaController extends Controller
{
    public function index()
    {
        $riwayat = Penyewaan::with([
            'user',
            'detail_penyewaan.barang'
        ])
            ->latest()
            ->get();

        $statusColors = [
            'Paid' => 'bg-green-100 text-green-700',
            'Unpaid' => 'bg-red-100 text-red-700',
            'Disewa' => 'bg-blue-100 text-blue-700',
            'Selesai' => 'bg-emerald-100 text-emerald-700',
        ];

        return view('admin.riwayat.index', compact('riwayat', 'statusColors'));
    }
    public function show($id)
    {
        $penyewaan = Penyewaan::with([
            'user',
            'detail_penyewaan.barang'
        ])->findOrFail($id);

        return view('admin.riwayat.detail', compact('penyewaan'));
    }
}