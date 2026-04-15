<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

    public function index()
    {
        $data = $this->getData();
        return view('admin.kategori', compact('data'));
    }
}