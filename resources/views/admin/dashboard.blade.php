@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-3xl font-black text-gray-900">Dashboard Admin</h2>
    <p class="text-gray-500">Ringkasan operasional dan laporan arus kas.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-emerald-500 to-emerald-700 p-6 rounded-2xl text-white shadow-lg">
        <p class="opacity-80 text-sm font-semibold uppercase">Pendapatan Bulan Ini</p>
        <p class="text-3xl font-black mt-1">Rp {{ number_format($data['pendapatan_bulan'], 0, ',', '.') }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-gray-500 text-sm font-semibold uppercase">Pendapatan Tahun Ini</p>
        <p class="text-2xl font-black text-gray-800 mt-1">Rp {{ number_format($data['pendapatan_tahun'], 0, ',', '.') }}</p>
    </div>
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <p class="text-gray-500 text-sm font-semibold uppercase">Total Pendapatan (Filter)</p>
        <p class="text-2xl font-black text-gray-800 mt-1">Rp {{ number_format($data['pendapatan_total'], 0, ',', '.') }}</p>
    </div>
</div>

<form method="GET" action="{{ route('admin.dashboard') }}" class="bg-white p-5 rounded-2xl shadow-sm border mb-8 flex flex-wrap gap-4 items-end">
    <div>
        <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Rentang Waktu</label>
        <select name="filter" class="border rounded-xl px-4 py-2 text-sm w-full">
            <option value="semua">Semua Waktu</option>
            <option value="hari" {{ request('filter') == 'hari' ? 'selected' : '' }}>Hari Ini</option>
            <option value="bulan" {{ request('filter') == 'bulan' ? 'selected' : '' }}>Bulan Ini</option>
            <option value="tahun" {{ request('filter') == 'tahun' ? 'selected' : '' }}>Tahun Ini</option>
            <option value="custom">Rentang Khusus</option>
        </select>
    </div>
    <input type="date" name="start_date" value="{{ request('start_date') }}" class="border rounded-xl px-4 py-2 text-sm">
    <span class="text-gray-400 self-center">s/d</span>
    <input type="date" name="end_date" value="{{ request('end_date') }}" class="border rounded-xl px-4 py-2 text-sm">
    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-blue-700">Terapkan</button>
    <a href="{{ route('admin.export.excel', request()->all()) }}" class="ml-auto bg-emerald-600 text-white px-6 py-2 rounded-xl text-sm font-bold hover:bg-emerald-700">Export CSV</a>
</form>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    @php
        $stats = [
            ['Total Alat', $data['total_alat'], 'border-yellow-400', 'fa-box'],
            ['Total Pinjaman', $data['total_pinjaman'], 'border-blue-400', 'fa-file-invoice'],
            ['Total User', $data['total_user'], 'border-purple-400', 'fa-users'],
            ['Keterlambatan', $data['jumlah_terlambat'], 'border-red-400', 'fa-exclamation-triangle'],
        ];
    @endphp
    @foreach($stats as $s)
    <div class="bg-white p-6 rounded-2xl border-l-4 {{ $s[2] }} shadow-sm">
        <div class="flex justify-between items-center">
            <p class="text-xs font-bold text-gray-400 uppercase">{{ $s[0] }}</p>
            <i class="fas {{ $s[3] }} text-gray-300"></i>
        </div>
        <p class="text-2xl font-black text-gray-800 mt-2">{{ $s[1] }}</p>
    </div>
    @endforeach
</div>

<div class="bg-white p-6 rounded-2xl shadow-sm border">
    <h3 class="font-bold text-gray-800 mb-6">Distribusi Barang Per Kategori</h3>
    <div class="space-y-4">
        @foreach($data['barang_per_kategori'] as $index => $kat)
            @php
                $colors = ['bg-blue-500', 'bg-emerald-500', 'bg-amber-500', 'bg-purple-500', 'bg-red-500', 'bg-cyan-500'];
                $percent = ($data['total_alat'] > 0) ? ($kat->barang_count / $data['total_alat'] * 100) : 0;
            @endphp
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="font-semibold text-gray-700">{{ $kat->nama_kategori }}</span>
                    <span class="font-black text-gray-900">{{ $kat->barang_count }} Item</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-3 overflow-hidden shadow-inner">
                    <div class="{{ $colors[$index % count($colors)] }} h-3 rounded-full transition-all duration-500" style="width: {{ $percent }}%"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection