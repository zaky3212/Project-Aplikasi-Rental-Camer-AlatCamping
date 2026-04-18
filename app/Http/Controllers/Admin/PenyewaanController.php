<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyewaan;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PenyewaanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penyewaan::with('barang');

        if ($request->has('search')) {
            $query->where('nama_penyewa', 'like', '%' . $request->search . '%');
        }

        $penyewaan = $query->latest()->get();
        $barang = Barang::all(); 
        
        return view('admin.penyewaan.index', compact('penyewaan', 'barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_penyewa' => 'required',
            'barang_id' => 'required',
            'no_hp' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after:tanggal_sewa',
        ]);

        $barang = Barang::findOrFail($request->barang_id);
        
        $start = Carbon::parse($request->tanggal_sewa);
        $end = Carbon::parse($request->tanggal_kembali);
        $days = $start->diffInDays($end) ?: 1; 
        $total = $days * $barang->harga_sewa;

        Penyewaan::create([
            'nama_penyewa' => $request->nama_penyewa,
            'barang_id' => $request->barang_id,
            'no_hp' => $request->no_hp,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'lama_sewa' => $days,
            'total_harga' => $total,
            'status' => 'disewa'
        ]);

        return redirect()->route('admin.penyewaan.index')
            ->with('success', 'Transaksi penyewaan berhasil dicatat!');
    }

    // Method UPDATE dipindahkan ke DALAM sini
    public function update(Request $request, $id)
    {
        $penyewaan = Penyewaan::findOrFail($id);

        if ($request->status == 'kembali') {
            $penyewaan->update([
                'status' => 'kembali'
            ]);
            
            return redirect()->route('admin.penyewaan.index')
                ->with('success', 'Barang telah berhasil dikembalikan!');
        }

        return redirect()->route('admin.penyewaan.index');
    }

    public function destroy($id)
    {
        $penyewaan = Penyewaan::findOrFail($id);
        $penyewaan->delete();

        return redirect()->route('admin.penyewaan.index')
            ->with('success', 'Data penyewaan berhasil dihapus!');
    }
} 