<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;

class PelangganController extends Controller
{
    public function index()
    {
        return view('pelanggan.dashboard'); // Mengarah ke folder pelanggan
    }
}
