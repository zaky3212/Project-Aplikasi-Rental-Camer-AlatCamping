<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Riwayat - Lenscape</title>
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

            <div class="grid grid-cols-2 gap-8 mb-10">
                <div class="bg-gray-50 p-5 rounded-2xl">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Tanggal Mulai</p>
                    <p class="font-bold text-gray-800 text-lg">{{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d M Y') }}</p>
                </div>
                <div class="bg-[#0f172a] p-5 rounded-2xl text-white">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">Total Harga</p>
                    <p class="font-bold text-xl text-[#f3a933]">Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-6 px-1">Daftar Item Disewa</h3>
                <div class="space-y-4">
                    @foreach($penyewaan->detail_penyewaan as $detail)
                    <div class="group flex justify-between items-center p-5 rounded-2xl border border-gray-100 hover:border-[#f3a933]/30 hover:shadow-md transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-100 shrink-0">
                                @if($detail->barang && $detail->barang->gambar)
                                <img src="{{ asset($detail->barang->gambar) }}"
                                    alt="{{ $detail->barang->nama }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-camera"></i>
                                </div>
                                @endif
                            </div>

                            <div>
                                <p class="font-bold text-gray-900">{{ $detail->barang->nama ?? 'Barang tidak ditemukan' }}</p>
                                <p class="text-xs text-gray-400 font-medium">
                                    Qty: {{ $detail->jumlah }} | Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <p class="font-bold text-gray-900 group-hover:text-[#f3a933] transition-colors">
                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>