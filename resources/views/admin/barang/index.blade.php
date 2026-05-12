@extends('layouts.admin')

@section('title', 'Kelola Barang - Admin Lenscape')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Daftar Barang</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola inventaris alat camping dan kamera.</p>
    </div>
    <div class="flex items-center gap-4">
        <div class="hidden sm:block text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
        </div>
        <button type="button" onclick="openModal('modalTambah')" class="bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow-sm font-semibold transition flex items-center gap-2 text-sm">
            <i class="fas fa-plus text-[#f3a933]"></i> Tambah Barang
        </button>
    </div>
</div>


<div class="mb-6 relative max-w-2xl">
    <form action="{{ route('admin.barang.index') }}" method="GET">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <i class="fas fa-search text-gray-400"></i>
        </span>
        <input type="text" name="search" value="{{ request('search') }}"
            placeholder="Cari Barang (contoh: Tenda)..."
            class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm">
    </form>
</div>

@if(session('success'))
<div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
    <i class="fas fa-check-circle"></i>
    <p class="font-medium text-sm">{{ session('success') }}</p>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6 overflow-x-auto">
    <table class="min-w-full text-sm text-left">
        <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 whitespace-nowrap">
            <tr>
                <th class="px-6 py-4 font-semibold">Foto</th>
                <th class="px-6 py-4 font-semibold">Nama Barang</th>
                <th class="px-6 py-4 font-semibold">Kategori</th>
                <th class="px-6 py-4 font-semibold">Harga/Hari</th>
                <th class="px-6 py-4 font-semibold text-center">Stok</th>
                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            {{-- DATA DUMMY MANUAL (Akan muncul jika data kosong) --}}
            @if($barang->isEmpty())
                <!-- Dummy 1 -->
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=100" class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-800">Canon EOS 90D (Dummy)</td>
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-600 px-2.5 py-1.5 rounded-md border border-gray-200 text-xs font-semibold whitespace-nowrap">Kamera</span>
                    </td>
                    <td class="px-6 py-4 font-bold text-emerald-600 whitespace-nowrap">Rp 150.000</td>
                    <td class="px-6 py-4 font-bold text-gray-700 text-center">5</td>
                    <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-2">
                    {{-- Tombol Edit Dummy --}}
                    <button type="button" class="bg-[#f3a933]/10 text-[#f3a933] hover:bg-[#f3a933] hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                        <i class="fas fa-pen"></i> <span class="hidden sm:inline">Edit</span>
                    </button>
                    {{-- Tombol Hapus Dummy --}}
                    <button type="button" class="bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                        <i class="fas fa-trash"></i> <span class="hidden sm:inline">Hapus</span>
                    </button>
                </div>
            </td>
                </tr>
                <!-- Dummy 2 -->
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?w=100" class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-800">Tenda Kapasitas 4 (Dummy)</td>
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-600 px-2.5 py-1.5 rounded-md border border-gray-200 text-xs font-semibold whitespace-nowrap">Alat Camping</span>
                    </td>
                    <td class="px-6 py-4 font-bold text-emerald-600 whitespace-nowrap">Rp 75.000</td>
                    <td class="px-6 py-4 font-bold text-gray-700 text-center">10</td>
                    <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-2">
                    {{-- Tombol Edit Dummy --}}
                    <button type="button" class="bg-[#f3a933]/10 text-[#f3a933] hover:bg-[#f3a933] hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                        <i class="fas fa-pen"></i> <span class="hidden sm:inline">Edit</span>
                    </button>
                    {{-- Tombol Hapus Dummy --}}
                    <button type="button" class="bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                        <i class="fas fa-trash"></i> <span class="hidden sm:inline">Hapus</span>
                    </button>
                </div>
            </td>
                </tr>
            @endif

            {{-- DATA ASLI DARI DATABASE --}}
            @foreach ($barang as $item)
            <tr class="hover:bg-gray-50 transition">
                <td class="px-6 py-4">
                    @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama }}" class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm">
                    @else
                    <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400 border border-gray-200"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td class="px-6 py-4 font-bold text-gray-800">{{ $item->nama }}</td>
                <td class="px-6 py-4">
                    <span class="bg-gray-100 text-gray-600 px-2.5 py-1.5 rounded-md border border-gray-200 text-xs font-semibold whitespace-nowrap">
                        {{ $item->kategori->nama_kategori ?? 'Tanpa Kategori' }}
                    </span>
                </td>
                <td class="px-6 py-4 font-bold text-emerald-600 whitespace-nowrap">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                <td class="px-6 py-4 font-bold text-gray-700 text-center">{{ $item->stok }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-center gap-2">
                        <button type="button" onclick="openModal('modalEdit-{{ $item->id }}')" class="bg-[#f3a933]/10 text-[#f3a933] hover:bg-[#f3a933] hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                            <i class="fas fa-pen"></i> <span class="hidden sm:inline">Edit</span>
                        </button>
                        <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg font-bold transition text-xs flex items-center gap-1">
                                <i class="fas fa-trash"></i> <span class="hidden sm:inline">Hapus</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mb-8">
    {{ $barang->withQueryString()->links() }}
</div>
@endsection