<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riwayat - Lenscape</title>
    <link rel="icon" href="{{ asset('images/Lenscape-Logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 pt-24">

    <div class="max-w-3xl mx-auto px-4 md:px-6 py-12">
        <a href="{{ route('pelanggan.riwayat.index') }}"
            class="group flex items-center text-sm text-gray-500 hover:text-[#f3a933] transition-all duration-300 mb-8">
            <span class="mr-2 group-hover:-translate-x-1 transition-transform">&larr;</span> Kembali ke Riwayat
        </a>

        <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 p-8 md:p-10">

            <div class="flex flex-col md:flex-row md:justify-between md:items-center border-b border-gray-100 pb-8 mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Detail Transaksi</h1>
                    <p class="text-gray-400 mt-1 font-medium">{{ $penyewaan->kode_transaksi }}</p>
                </div>
                <div class="inline-flex">
                    <span class="px-5 py-2 bg-emerald-50 text-emerald-700 font-bold text-xs uppercase tracking-widest rounded-full border border-emerald-100">
                        {{ $penyewaan->status }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-gray-50 p-5 rounded-2xl">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Tanggal Mulai</p>
                    <p class="font-bold text-gray-800 text-lg">{{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d M Y') }}</p>
                </div>
                <div class="bg-gray-50 p-5 rounded-2xl">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Tanggal Selesai</p>
                    <p class="font-bold text-gray-800 text-lg">{{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d M Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10">
                <div class="bg-red-50 p-5 rounded-2xl border border-red-100">
                    <p class="text-red-400 text-xs font-bold uppercase tracking-widest mb-1">Denda</p>
                    @if($penyewaan->denda > 0)
                    <p class="font-bold text-red-600 text-lg">Rp {{ number_format($penyewaan->denda, 0, ',', '.') }}</p>
                    <p class="text-[9px] text-red-500 mt-1 italic">{{ $penyewaan->alasan_denda }}</p>
                    @else
                    <p class="font-bold text-gray-400 text-lg">-</p>
                    @endif
                </div>
                <div class="bg-[#0f172a] p-5 rounded-2xl text-white">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Total Harga</p>
                    <p class="font-bold text-xl text-[#f3a933]">Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

</body>

</html>