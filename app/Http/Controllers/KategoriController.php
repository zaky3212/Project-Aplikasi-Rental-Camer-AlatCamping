<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Mengambil data kategori (data dummy sesuai instruksi)
    public function getData()
    {
        $data = [
            ['id' => 1, 'nama' => 'Kamera'],
            ['id' => 2, 'nama' => 'Lensa'],
            ['id' => 3, 'nama' => 'Tripod'],
            ['id' => 4, 'nama' => 'Tenda Camping'],
        ];

        return $data;
    }

    // Menampilkan view kategori
    public function tampilkan()
    {
        $data = $this->getData();

        return view('kategori', compact('data'));
    }
}