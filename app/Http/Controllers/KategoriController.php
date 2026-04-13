<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function getData()
    {
        return [
            ['id' => 1, 'nama' => 'Kamera'],
            ['id' => 2, 'nama' => 'Lensa'],
            ['id' => 3, 'nama' => 'Alat Camping'],
        ];
    }

    public function tampilkan()
    {
        $data = $this->getData();
        return view('kategori', compact('data'));
    }
}