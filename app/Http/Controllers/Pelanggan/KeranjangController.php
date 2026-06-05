<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;

class KeranjangController extends Controller
{
    // 1. Nampilin isi keranjang
    public function index()
    {
        // Ambil data dari session, kalau kosong jadikan array kosong
        $keranjang = session()->get('keranjang', []);
        
        // Hitung total harga otomatis dari session
        $subtotal = 0;
        foreach($keranjang as $item) {
            $subtotal += $item['harga_sewa'] * $item['lama_sewa'];
        }

        return view('pelanggan.keranjang.index', compact('keranjang', 'subtotal'));
    }

    // 2. Nambah barang ke keranjang
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
        ]);

        $barang = Barang::with('kategori')->findOrFail($request->barang_id);
        $keranjang = session()->get('keranjang', []);

        // Kalau barang udah ada di keranjang, tambah durasinya 1 hari
        if(isset($keranjang[$barang->id])) {
            $keranjang[$barang->id]['lama_sewa']++;
        } else {
            // Kalau belum ada, masukin data baru ke keranjang
            $keranjang[$barang->id] = [
                'id' => $barang->id,
                'nama' => $barang->nama,
                'kategori' => $barang->kategori->nama_kategori ?? 'Umum',
                'harga_sewa' => $barang->harga_sewa,
                'lama_sewa' => 1,
                'gambar' => $barang->gambar ? asset($barang->gambar) : 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=400',
            ];
        }

        session()->put('keranjang', $keranjang);
        return redirect()->route('pelanggan.keranjang.index')->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    // 3. Nambah / Ngurangin Durasi Sewa di keranjang
    public function update(Request $request, $id)
    {
        $keranjang = session()->get('keranjang', []);
        
        if(isset($keranjang[$id])) {
            if($request->action == 'plus') {
                $keranjang[$id]['lama_sewa']++;
            } elseif($request->action == 'minus') {
                if($keranjang[$id]['lama_sewa'] > 1) {
                    $keranjang[$id]['lama_sewa']--;
                }
            }
            session()->put('keranjang', $keranjang);
        }
        
        return redirect()->route('pelanggan.keranjang.index');
    }

    // 4. Hapus barang dari keranjang
    public function destroy($id)
    {
        $keranjang = session()->get('keranjang', []);
        
        if(isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }
        
        return redirect()->route('pelanggan.keranjang.index')->with('success', 'Barang dihapus dari keranjang.');
    }
}