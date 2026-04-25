<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang; 
use Illuminate\Support\Facades\Auth;

class PenyewaanPelangganController extends Controller
{
 public function index()
    {
        $barangs = []; 
        return view('pelanggan.sewa.penyewaan', compact('barangs'));
    }
    public function store(Request $request)
    {
        return redirect()->back()->with('success', 'Berhasil!');
    }
}

