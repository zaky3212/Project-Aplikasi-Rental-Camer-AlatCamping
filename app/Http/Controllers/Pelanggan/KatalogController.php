<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Menampilkan produk yang filternya berdasarkan kategori KAMERA
     */
    public function katalogCamera()
    {
        $categories = Kategori::with(['barang' => function($query) {
                $query->latest();
            }])
            ->where(function($q) {
                $q->where('nama_kategori', 'like', '%Kamera%')
                  ->orWhere('nama_kategori', 'like', '%camera%')
                  ->orWhere('nama_kategori', 'like', '%Lensa%');
            })
            ->has('barang') // Menyembunyikan kategori jika belum ada barangnya
            ->get();

        return view('pelanggan.Katalog.Katalog_Camera', compact('categories'));
    }

    /**
     * Menampilkan produk yang filternya berdasarkan kategori CAMPING
     * FIX: Menggunakan sistem pengecualian (Not Like) agar kategori outdoor baru otomatis masuk
     */
    public function katalogCamping()
    {
        $categories = Kategori::with(['barang' => function($query) {
                $query->latest();
            }])
            ->where(function($q) {
                // Mengambil semua kategori KECUALI yang berhubungan dengan kamera
                $q->where('nama_kategori', 'not like', '%Kamera%')
                  ->where('nama_kategori', 'not like', '%camera%')
                  ->where('nama_kategori', 'not like', '%Lensa%');
            })
            ->has('barang') // PASTIKAN: Di panel admin, kategori Sleeping Bag sudah diisi minimal 1 barang!
            ->get();

        return view('pelanggan.Katalog.Katalog_Camping', compact('categories'));
    }

    /**
     * MENAMPILKAN HALAMAN LIHAT SEMUA KATALOG KAMERA
     */
    public function lihatSemuaCamera()
    {
        $categories = Kategori::with(['barang' => function($query) {
                $query->latest();
            }])
            ->where(function($q) {
                $q->where('nama_kategori', 'like', '%Kamera%')
                  ->orWhere('nama_kategori', 'like', '%camera%')
                  ->orWhere('nama_kategori', 'like', '%Lensa%');
            })
            ->has('barang')
            ->get();

        return view('pelanggan.Katalog.Lihat_Semua_Camera', compact('categories'));
    }

    /**
     * MENAMPILKAN HALAMAN LIHAT SEMUA KATALOG CAMPING
     * FIX: Menggunakan logika pengecualian yang sama agar sinkron
     */
    public function lihatSemuaCamping()
    {
        $categories = Kategori::with(['barang' => function($query) {
                $query->latest();
            }])
            ->where(function($q) {
                $q->where('nama_kategori', 'not like', '%Kamera%')
                  ->where('nama_kategori', 'not like', '%camera%')
                  ->where('nama_kategori', 'not like', '%Lensa%');
            })
            ->has('barang')
            ->get();

        return view('pelanggan.Katalog.Lihat_Semua_Camping', compact('categories'));
    }

    public function detailBarang($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);

        return view('pelanggan.Katalog.Detail_Barang', compact('barang'));
    }
}