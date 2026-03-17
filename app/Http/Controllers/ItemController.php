<?php

namespace App\Http\Controllers;

class ItemController extends Controller
{
    public function index()
    {
        $items = [
            ['nama' => 'Kamera Canon 80D', 'kategori' => 'Kamera', 'stok' => 5, 'harga' => 150000],
            ['nama' => 'Lensa 50mm', 'kategori' => 'Lensa', 'stok' => 10, 'harga' => 50000],
            ['nama' => 'Tripod Takara', 'kategori' => 'Aksesoris', 'stok' => 7, 'harga' => 30000],
        ];

        return view('item.list', compact('items'));
    }
}