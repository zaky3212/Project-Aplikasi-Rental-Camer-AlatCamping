<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data barang
        $kameraPilihan = Barang::whereHas('kategori', function($query) {
                $query->where('nama_kategori', 'like', '%Kamera%')
                      ->orWhere('nama_kategori', 'like', '%camera%')
                      ->orWhere('nama_kategori', 'like', '%Lensa%');
            })->latest()->take(4)->get();

        $campingFavorit = Barang::whereHas('kategori', function($query) {
                $query->where('nama_kategori', 'not like', '%Kamera%')
                      ->where('nama_kategori', 'not like', '%camera%')
                      ->where('nama_kategori', 'not like', '%Lensa%');
            })->latest()->take(4)->get();

        // 2. Logika pengecekan Auth
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return view('pelanggan.dashboard', compact('kameraPilihan', 'campingFavorit'));
        }

        // 3. Jika tamu
        return view('welcome', compact('kameraPilihan', 'campingFavorit'));
    } // <--- KURUNG INI MENUTUP METHOD INDEX

    // Method lain tetap berada di dalam class
    public function create() { /* ... */ }
    public function store(Request $request) { /* ... */ }
    public function show(string $id) { /* ... */ }
    public function edit(string $id) { /* ... */ }
    public function update(Request $request, string $id) { /* ... */ }
    public function destroy(string $id) { /* ... */ }

} 