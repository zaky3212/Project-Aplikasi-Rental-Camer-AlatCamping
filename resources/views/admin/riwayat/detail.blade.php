@extends('layouts.admin')

@section('title', 'Detail Riwayat Sewa')

@section('content')

<div class="max-w-4xl mx-auto">

    <a href="{{ route('admin.riwayat.index') }}"
        class="group flex items-center text-sm text-gray-500 hover:text-[#f3a933] transition-all duration-300 mb-8">
        <span class="mr-2 group-hover:-translate-x-1 transition-transform">&larr;</span>
        Kembali ke Riwayat
    </a>

    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-200 p-8">

        <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b border-gray-100 pb-8 mb-8">

            <div>
                <h1 class="text-3xl font-bold text-[#0f172a]">
                    Detail Transaksi
                </h1>

                <p class="text-gray-500 mt-2">
                    {{ $penyewaan->kode_transaksi }}
                </p>
            </div>

            <span class="px-5 py-2 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase">
                {{ $penyewaan->status }}
            </span>

        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-6">

            <div class="bg-gray-50 rounded-xl p-5">
                <p class="text-xs uppercase text-gray-400 font-bold">
                    Pelanggan
                </p>

                <p class="text-lg font-semibold text-gray-800 mt-2">
                    {{ $penyewaan->user->name }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-5">
                <p class="text-xs uppercase text-gray-400 font-bold">
                    Total Harga
                </p>

                <p class="text-lg font-bold text-[#0f172a] mt-2">
                    Rp {{ number_format($penyewaan->total_harga,0,',','.') }}
                </p>
            </div>

        </div>

        <div class="grid md:grid-cols-2 gap-4 mb-6">

            <div class="bg-gray-50 rounded-xl p-5">
                <p class="text-xs uppercase text-gray-400 font-bold">
                    Tanggal Mulai
                </p>

                <p class="text-lg font-semibold">
                    {{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d M Y') }}
                </p>
            </div>

            <div class="bg-gray-50 rounded-xl p-5">
                <p class="text-xs uppercase text-gray-400 font-bold">
                    Tanggal Selesai
                </p>

                <p class="text-lg font-semibold">
                    {{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d M Y') }}
                </p>
            </div>

        </div>

        <div class="bg-red-50 border border-red-100 rounded-xl p-5">

            <p class="text-xs uppercase text-red-400 font-bold">
                Denda
            </p>

            @if($penyewaan->denda > 0)

                <p class="text-lg font-bold text-red-600 mt-2">
                    Rp {{ number_format($penyewaan->denda,0,',','.') }}
                </p>

                <p class="text-sm text-red-500 mt-1">
                    {{ $penyewaan->alasan_denda }}
                </p>

            @else

                <p class="text-lg text-gray-500 mt-2">
                    Tidak ada denda
                </p>

            @endif

        </div>

    </div>

</div>

@endsection