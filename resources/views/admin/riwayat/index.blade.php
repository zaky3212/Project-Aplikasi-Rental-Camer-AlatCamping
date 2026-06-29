@extends('layouts.admin')

@section('title', 'Riwayat Sewa')

@section('content')

    <div class="max-w-7xl mx-auto">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-[#0f172a]">
                Riwayat Sewa
            </h1>
            <p class="text-gray-500 mt-2">
                Daftar seluruh transaksi penyewaan pelanggan.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                Kode Transaksi
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                Pelanggan
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                Periode Sewa
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                Total Harga
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                Denda
                            </th>

                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                Status
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-bold uppercase text-gray-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @forelse($riwayat as $item)

                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $item->kode_transaksi }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $item->user->name }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">

                                    @if($item->denda > 0)
                                        <span class="text-red-600 font-semibold">
                                            Rp {{ number_format($item->denda, 0, ',', '.') }}
                                        </span>
                                    @else
                                        -
                                    @endif

                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 {{ $statusColors[$item->status] ?? 'bg-gray-100 text-gray-700' }} rounded-full text-xs font-semibold">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.riwayat.detail', $item->id) }}"
                                        class="text-xs font-bold text-[#0f172a] hover:text-[#f3a933] transition">
                                        Detail
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-500">
                                    Belum ada riwayat penyewaan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection