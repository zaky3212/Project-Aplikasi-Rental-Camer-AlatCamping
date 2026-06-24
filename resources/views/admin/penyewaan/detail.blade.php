@extends('layouts.admin')

@section('title', 'Detail Penyewaan - Lenscape')

@section('content')

<div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">
            Detail Riwayat Penyewaan
        </h2>
        <p class="text-sm text-gray-500 mt-1">
            Informasi lengkap transaksi penyewaan
        </p>
    </div>

    <a href="{{ route('admin.penyewaan.index') }}"
       class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
        Kembali
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">

    <div class="grid md:grid-cols-2 gap-4">

        <div>
            <p class="text-gray-500 text-sm">Kode Transaksi</p>
            <p class="font-bold text-lg">
                {{ $penyewaan->kode_transaksi }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Nama Penyewa</p>
            <p class="font-semibold">
                {{ $penyewaan->user->name ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Status</p>
            <p class="font-semibold">
                {{ $penyewaan->status }}
            </p>
        </div>

        <div>
            <p class="text-gray-500 text-sm">Total Harga</p>
            <p class="font-bold text-green-600">
                Rp {{ number_format($penyewaan->total_harga,0,',','.') }}
            </p>
        </div>

    </div>

</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

    <div class="px-6 py-4 border-b">
        <h3 class="font-bold text-gray-800">
            Daftar Barang Disewa
        </h3>
    </div>

    <div class="overflow-x-auto">

        <table class="min-w-full text-sm">

            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left">Nama Barang</th>
                    <th class="px-6 py-4 text-left">Harga Sewa</th>
                </tr>
            </thead>

            <tbody>

                @foreach($penyewaan->detail_penyewaan as $detail)

                <tr class="border-t">
                    <td class="px-6 py-4">
                        {{ $detail->barang->nama }}
                    </td>

                    <td class="px-6 py-4">
                        Rp {{ number_format($detail->barang->harga_sewa,0,',','.') }}
                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection