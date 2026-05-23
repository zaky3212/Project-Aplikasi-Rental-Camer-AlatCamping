<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;

class PelangganController extends Controller
{
    public function index()
    {
        return view('pelanggan.profile'); // Mengarah ke folder pelanggan
    }
}
