@extends('layouts.pelanggan')

@section('title', 'Riwayat Sewa - Lenscape')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-16">

    <!-- HEADER -->
    <div class="mb-8">
        <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900">Riwayat Sewa</h1>
        <p class="text-gray-500 mt-2 text-sm md:text-base">Daftar transaksi penyewaan yang pernah Anda lakukan.</p>
    </div>

    <!-- TABEL RIWAYAT TRANSAKSI -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Kode Transaksi</th>
                        <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Periode Sewa</th>
                        <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Harga</th>
                        <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Denda</th>
                        <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($penyewaans as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-5 px-6 font-bold text-gray-800 text-sm">{{ $item->kode_transaksi }}</td>
                        <td class="py-5 px-6 text-gray-600 text-sm">
                            {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                            <span class="text-gray-400 font-bold mx-1">/</span>
                            {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                        </td>
                        <td class="py-5 px-6 font-black text-gray-900 text-sm">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                        <td class="py-5 px-6 text-sm">
                            @if($item->denda > 0)
                            <span class="font-bold text-red-600">Rp {{ number_format($item->denda, 0, ',', '.') }}</span>
                            @else
                            <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-5 px-6">
                            <span class="px-3 py-1 {{ $statusColors[$item->status] ?? 'bg-gray-100' }} text-[9px] font-black uppercase rounded-full">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="py-5 px-6">
                            <a href="{{ route('pelanggan.riwayat.detail', $item->id) }}" class="text-xs font-bold text-[#0f172a] hover:text-[#f3a933] transition">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-10 text-center text-gray-400 text-sm">Belum ada riwayat sewa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection