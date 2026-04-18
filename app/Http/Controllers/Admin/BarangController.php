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
     * Menampilkan halaman utama (Tabel + Modals)
     */
    public function index(Request $request)
    {
        $query = Barang::with('kategori')->latest();

        if ($request->has('search') && $request->search != '') {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // 🔥 UBAH ->get() JADI ->paginate()
        // Angka 5 berarti nampilin 5 barang per halaman. Bisa lu ganti 10 atau berapapun.
        $barang = $query->paginate(5);

        $kategori = Kategori::all();

        return view('admin.barang.index', compact('barang', 'kategori'));
    }

    /**
     * Menyimpan data baru dari Modal Tambah
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Proses Upload Gambar
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
     * Update data dari Modal Edit
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga_sewa' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $barang = Barang::findOrFail($id);
        $data = $request->all();

        // Proses Update Gambar (Hapus yang lama, simpan yang baru)
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
     * Hapus data
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus file fisik gambar biar nggak menuhin memori hosting
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
