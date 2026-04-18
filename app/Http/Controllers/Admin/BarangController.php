<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori; // Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index()
    {
        // Ambil barang beserta relasi kategorinya
        $barang = Barang::with('kategori')->latest()->get();
        
        // Ambil semua kategori untuk modal tambah barang
        $kategori = Kategori::all(); 

        return view('admin.barang.index', compact('barang', 'kategori'));
    }

    public function store(Request $request)
    {
        // Tambahkan 'kategori_id' ke validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id', // Sesuai dengan nama tabel kategori Anda
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Logika Upload Gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/barang'), $imageName);
            $data['gambar'] = 'images/barang/' . $imageName;
        }

        Barang::create($data);

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all(); // Tambahkan kategori agar bisa ganti kategori saat edit
        
        return view('admin.barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = Barang::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($barang->gambar && File::exists(public_path($barang->gambar))) {
                File::delete(public_path($barang->gambar));
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/barang'), $imageName);
            $data['gambar'] = 'images/barang/' . $imageName;
        }

        $barang->update($data);

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar && File::exists(public_path($barang->gambar))) {
            File::delete(public_path($barang->gambar));
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}