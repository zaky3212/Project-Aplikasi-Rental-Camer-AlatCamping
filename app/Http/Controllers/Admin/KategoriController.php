<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        // mengambil kategori + relasi barang
        $query = Kategori::with('barang')->latest();

        // fitur search
        if ($request->has('search') && $request->search != '') {

            $query->where('nama_kategori', 'like', '%' . $request->search . '%');

        }

        // pagination
        $kategori = $query->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required'
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil diupdate!');
    }

    public function destroy($id)
    {
        $kategori = Kategori::with('barang')->findOrFail($id);

        // cek apakah kategori masih dipakai barang
        if ($kategori->barang->count() > 0) {

            return redirect()->route('admin.kategori.index')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki barang!');
        }
        $kategori->delete();

        return redirect()->route('admin.kategori.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}