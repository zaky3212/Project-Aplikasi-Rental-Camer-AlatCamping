<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Barang, Penyewaan, User, Kategori};
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
   public function index(Request $request)
{
    $filter = $request->input('filter', 'semua');
    $start  = $request->input('start_date');
    $end    = $request->input('end_date');

    $query = Penyewaan::query();

    // Logika Filter
    if ($filter == 'hari') $query->whereDate('created_at', Carbon::today());
    elseif ($filter == 'bulan') $query->whereMonth('created_at', Carbon::now()->month);
    elseif ($filter == 'tahun') $query->whereYear('created_at', Carbon::now()->year);
    elseif ($filter == 'custom' && $start && $end) $query->whereBetween('created_at', [$start, $end]);

    $data = [
        'total_alat'           => Barang::sum('stok'),
        'total_pinjaman'       => $query->count(),
        'total_user'           => User::where('role', 'pelanggan')->count(),
        'pendapatan_total'     => $query->sum('total_harga'),
        'pendapatan_bulan'     => Penyewaan::whereMonth('created_at', Carbon::now()->month)->sum('total_harga'),
        'pendapatan_tahun'     => Penyewaan::whereYear('created_at', Carbon::now()->year)->sum('total_harga'),
        'jumlah_terlambat'     => $query->where(function($q) {
                                      $q->where('status', 'terlambat')->orWhere('denda', '>', 0);
                                  })->count(),
        'barang_per_kategori'  => Kategori::withCount('barang')->get(),
        'filter'               => $filter
    ];

    return view('admin.dashboard', compact('data'));
}

    public function exportExcel(Request $request)
    {
        $filter = $request->input('filter', 'semua');
        $query = Penyewaan::query();

        if ($filter == 'hari') $query->whereDate('created_at', Carbon::today());
        elseif ($filter == 'bulan') $query->whereMonth('created_at', Carbon::now()->month);
        elseif ($filter == 'tahun') $query->whereYear('created_at', Carbon::now()->year);

        $data = $query->get();

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID Transaksi', 'Total Harga', 'Status', 'Tanggal']);
            foreach ($data as $row) {
                fputcsv($file, [$row->id, $row->total_harga, $row->status, $row->created_at]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=Laporan_Penyewaan.csv"
        ]);
    }
}
