<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        // Simulasi data keranjang (Nanti lu bisa ganti pakai query ke database Keranjang/Session)
        $keranjang = collect([
            (object)[
                'id' => 1,
                'nama' => 'Sony Alpha A6000',
                'kategori' => 'Kamera',
                'harga_sewa' => 150000,
                'lama_sewa' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=400'
            ],
            (object)[
                'id' => 2,
                'nama' => 'Tenda Dome Kapasitas 4',
                'kategori' => 'Alat Camping',
                'harga_sewa' => 45000,
                'lama_sewa' => 2,
                'gambar' => 'https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80&w=400'
            ]
        ]);

        // Hitung total harga otomatis
        $subtotal = $keranjang->sum(function($item) {
            return $item->harga_sewa * $item->lama_sewa;
        });

        return view('pelanggan.keranjang.index', compact('keranjang', 'subtotal'));
    }

    public function destroy($id)
    {
        // Logika untuk menghapus item dari keranjang nanti taruh sini
        return redirect()->back()->with('success', 'Barang berhasil dihapus dari keranjang.');
    }
}