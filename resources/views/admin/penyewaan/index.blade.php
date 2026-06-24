@extends('layouts.admin')

@section('title', 'Kelola Penyewaan - Lenscape')

@section('content')

<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
    <div>
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Kelola Penyewaan</h2>
        <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar transaksi penyewaan online dari Midtrans</p>
    </div>
</div>

@if(session('success'))
<div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
    <i class="fas fa-check-circle"></i>
    <p class="font-medium text-sm">{{ session('success') }}</p>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 whitespace-nowrap">
                <tr>
                    <th class="px-6 py-4 font-semibold">Kode Transaksi</th>
                    <th class="px-6 py-4 font-semibold">Nama Penyewa</th>
                    <th class="px-6 py-4 font-semibold">Masa Sewa / Deadline</th>
                    <th class="px-6 py-4 font-semibold text-center">Status</th>
                    <th class="px-6 py-4 font-semibold text-center">Denda Terbaca</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse ($penyewaans as $item)
                @php
                $tglSelesai = \Carbon\Carbon::parse($item->tanggal_selesai)->startOfDay();
                $hariIni = \Carbon\Carbon::now()->startOfDay();
                $selisih = $hariIni->diffInDays($tglSelesai, false); // Hasil plus = sisa hari, minus = telat
                @endphp
                <tr class="hover:bg-gray-50/50 transition">
                    <td class="px-6 py-4 font-bold text-gray-800 whitespace-nowrap">{{ $item->kode_transaksi }}</td>
                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $item->user->name ?? 'User Terhapus' }}</td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-xs text-gray-600 font-medium mb-1">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                        </div>
                        @if($item->status == 'Disewa')
                        @if($selisih > 0)
                        <span class="px-2 py-0.5 bg-emerald-100 text-emerald-700 rounded-md text-[10px] font-bold">Sisa {{ $selisih }} Hari</span>
                        @elseif($selisih == 0)
                        <span class="px-2 py-0.5 bg-orange-100 text-orange-700 rounded-md text-[10px] font-bold">Batas Hari Ini!</span>
                        @else
                        <span class="px-2 py-0.5 bg-red-100 text-red-700 rounded-md text-[10px] font-bold animate-pulse">Telat {{ abs($selisih) }} Hari!</span>
                        @endif
                        @elseif($item->status == 'Selesai')
                        <span class="text-[10px] text-gray-400 font-bold uppercase"><i class="fas fa-check-circle text-emerald-500"></i> Sudah Dikembalikan</span>
                        @else
                        <span class="text-[10px] text-gray-400 font-bold">Menunggu Pengambilan</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($item->status == 'Unpaid')
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-[10px] font-black uppercase">Unpaid</span>
                        @elseif($item->status == 'Paid')
                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-black uppercase">Paid (Lunas)</span>
                        @elseif($item->status == 'Disewa')
                        <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-[10px] font-black uppercase">Disewa</span>
                        @elseif($item->status == 'Selesai')
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-black uppercase">Selesai</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($item->denda > 0)
                        <div class="text-red-600 font-black whitespace-nowrap">Rp {{ number_format($item->denda, 0, ',', '.') }}</div>
                        <div class="text-[9px] text-red-400 font-bold uppercase mt-0.5"><i class="fas fa-info-circle"></i> {{ $item->alasan_denda }}</div>
                        @else
                        <span class="text-gray-300 font-bold">-</span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if($item->status == 'Paid')
                        <form action="{{ route('admin.penyewaan.updateStatus', $item->id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="Disewa">
                            <button type="submit" class="bg-[#0f172a] hover:bg-gray-800 text-white px-4 py-1.5 rounded-lg text-xs font-bold transition">Serahkan Alat</button>
                        </form>
                        @elseif($item->status == 'Disewa')
                        <form action="{{ route('admin.penyewaan.updateStatus', $item->id) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="Selesai">
                            <button type="submit" onclick="return confirm('Selesaikan sewa? Stok otomatis kembali bertambah!')" class="bg-[#f3a933] hover:bg-[#d98e1d] text-[#0f172a] px-4 py-1.5 rounded-lg text-xs font-bold transition">Barang Kembali</button>
                        </form>
                        @else
                        <span class="text-gray-400 text-xs italic">Selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">Belum ada data transaksi dari database.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection