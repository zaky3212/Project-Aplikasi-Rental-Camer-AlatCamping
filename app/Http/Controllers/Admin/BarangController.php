<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index()
    {
        // Ambil semua barang tanpa relasi kategori
        $barang = Barang::latest()->get();
        return view('admin.barang.index', compact('barang'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        // Validasi tanpa kategori
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
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
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, string $id)
    {
        // Validasi tanpa kategori
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = Barang::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('gambar')) {
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