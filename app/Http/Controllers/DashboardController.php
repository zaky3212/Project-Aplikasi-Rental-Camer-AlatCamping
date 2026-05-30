<?php

namespace App\Http\Controllers;

use App\Models\Barang; // PENTING: Tambahkan ini agar bisa memanggil data barang
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // 1. Ambil 4 barang TERBARU (Kamera)
    $kameraPilihan = Barang::whereHas('kategori', function($query) {
            $query->where('nama_kategori', 'like', '%Kamera%')
                  ->orWhere('nama_kategori', 'like', '%camera%')
                  ->orWhere('nama_kategori', 'like', '%Lensa%');
        })
        ->latest()
        ->take(4)
        ->get();

    // 2. Ambil 4 barang TERBARU (Camping)
    $campingFavorit = Barang::whereHas('kategori', function($query) {
            $query->where('nama_kategori', 'not like', '%Kamera%')
                  ->where('nama_kategori', 'not like', '%camera%')
                  ->where('nama_kategori', 'not like', '%Lensa%');
        })
        ->latest()
        ->take(4)
        ->get();

    // FIX: Arahkan ke views/pelanggan/dashboard.blade.php
    return view('pelanggan.dashboard', compact('kameraPilihan', 'campingFavorit'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}