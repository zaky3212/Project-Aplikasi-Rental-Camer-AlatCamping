<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar barang dengan fitur pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori')->latest();

        // Fitur pencarian berdasarkan Nama atau Merk
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('merk', 'like', '%' . $request->search . '%');
            });
        }

        $barang = $query->paginate(5);
        $kategori = Kategori::all();

        return view('admin.barang.index', compact('barang', 'kategori'));
    }

    /**
     * Memproses penyimpanan data barang baru ke database.
     */
    public function store(Request $request)
{
        $request->validate([
            'merk' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi' => 'required|string', // Validasi Kondisi
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Penanganan unggah file gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/barang'), $imageName);
            $data['gambar'] = 'images/barang/' . $imageName;
        }

        Barang::create($data);

        return redirect()->route('admin.barang.index')->with('success', 'Barang baru berhasil ditambahkan!');
    }

    /**
     * Memperbarui data barang yang sudah ada.
     */
    public function update(Request $request, string $id)
{
        $request->validate([
            'merk' => 'required|string|max:100',
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi' => 'required|string', // Validasi Kondisi
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
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

        return redirect()->route('admin.barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    /**
     * Menghapus data barang dan file gambarnya dari server.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar && File::exists(public_path($barang->gambar))) {
            File::delete(public_path($barang->gambar));
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus dari sistem!');
    }

    public function create() {}
    public function show(string $id) {}
    public function edit(string $id) {}
}