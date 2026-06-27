<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Lengkap Kamera - Lenscape</title>
    <link rel="icon" href="{{ asset('images/Lenscape-Logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans overflow-x-hidden pt-24">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/90 backdrop-blur-lg border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center transition-all">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white z-10">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>
        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="hover:text-[#f3a933] transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="text-[#f3a933] transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="hover:text-[#f3a933] transition">Katalog Camping</a>
            <a href="{{ route('pelanggan.riwayat.index') }}"
                class="{{ Route::is('pelanggan.riwayat.*') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">
                Riwayat Sewa
            </a>
            <a href="{{ route('pelanggan.profile') }}" class="hover:text-[#f3a933] transition">Profil</a>
        </div>
        <div class="flex items-center gap-4 md:gap-6 z-10">
            <a href="{{ route('pelanggan.keranjang.index') }}" class="text-white hover:text-[#f3a933] transition relative flex items-center mt-1">
                <i class="fas fa-shopping-cart text-lg"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[8px] font-black px-1.5 py-0.5 rounded-full border border-[#0f172a]">2</span>
            </a>
            <div class="h-6 w-[1px] bg-white/20 hidden xs:block"></div>
            <div class="relative flex items-center gap-2 md:gap-3">
                <span class="text-white text-[10px] md:text-xs hidden md:block uppercase tracking-wider font-medium">{{ Auth::user()->name ?? 'Pelanggan' }}</span>
                <div id="profileMenuButton" class="w-8 h-8 md:w-10 md:h-10 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] text-xs md:text-sm shadow-inner cursor-pointer select-none active:scale-95 transition-transform">
                    {{ substr(Auth::user()->name ?? 'P', 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-8 space-y-12">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-6">
            <div class="flex items-center gap-4">
                <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}"
                    class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-[#0f172a] hover:text-white hover:border-[#0f172a] transition duration-300 shadow-sm group"
                    title="Kembali ke Katalog">
                    <i class="fas fa-arrow-left text-sm transition-transform group-hover:-translate-x-1"></i>
                </a>

                <div>
                    <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Perlengkapan Kamera</h1>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Menampilkan seluruh sub-kategori perangkat fotografi aktif.</p>
                </div>
            </div>

            <div class="w-full md:w-80 relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <i class="fas fa-search text-xs"></i>
                </span>
                <input type="text" placeholder="Cari Kategori Barang (misal: Tenda Eiger)..." class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-gray-300 focus:outline-none focus:border-[#f3a933] bg-white text-gray-700 shadow-sm transition">
            </div>
        </div>

        @foreach($categories as $cat)
        <section class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">{{ $cat->nama_kategori }}</h2>
                    <div class="h-1 w-12 bg-[#f3a933] mt-1.5 rounded-full"></div>
                </div>
                <div class="flex items-center gap-1.5">
                    <button class="w-7 h-7 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-100 transition text-[10px]">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="w-7 h-7 rounded-lg bg-gray-50 border border-gray-200 flex items-center justify-center text-gray-700 hover:bg-gray-100 transition text-[10px]">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5">
                @foreach($cat->barang as $item)
                <a href="{{ route('pelanggan.Katalog.detail_barang', $item->id) }}" class="bg-gray-50/60 rounded-2xl border border-gray-100 p-3 flex flex-col justify-between hover:shadow-md transition duration-300 group relative text-left block">

                    <div class="absolute top-5 right-5 z-10">
                        @if($item->stok > 0)
                        <span class="px-2 py-0.5 bg-emerald-500 text-white text-[7px] font-black uppercase rounded-full shadow">Tersedia</span>
                        @else
                        <span class="px-2 py-0.5 bg-red-500 text-white text-[7px] font-black uppercase rounded-full shadow">Habis</span>
                        @endif
                    </div>

                    <div class="aspect-square w-full bg-white rounded-xl p-3 flex items-center justify-center relative overflow-hidden shadow-sm">
                        @if($item->gambar)
                        <img src="{{ asset($item->gambar) }}" class="max-h-full object-contain transition duration-500 group-hover:scale-105" alt="{{ $item->nama }}">
                        @else
                        <div class="text-center text-gray-300">
                            <i class="fas fa-camera text-2xl mb-1 block"></i>
                            <span class="text-[9px] font-medium text-gray-400">No Image</span>
                        </div>
                        @endif
                    </div>

                    <div class="mt-3 space-y-1 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-[8px] font-bold text-[#f3a933] uppercase tracking-wider block">{{ $item->merk }}</span>
                            <h3 class="font-bold text-gray-800 text-xs line-clamp-1 group-hover:text-[#f3a933] transition" title="{{ $item->nama }}">
                                {{ $item->nama }}
                            </h3>
                            <p class="text-[9px] text-gray-400 font-medium">Stok: {{ $item->stok }} Unit</p>
                        </div>

                        <div class="pt-2 border-t border-gray-200/60 mt-2">
                            <div class="text-center mb-2">
                                <span class="text-[11px] font-black text-gray-900 block">
                                    Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}<span class="text-[8px] text-gray-400 font-normal">/Hari</span>
                                </span>
                            </div>
                            <form action="{{ route('pelanggan.keranjang.index') }}" method="GET">
                                <button type="submit" {{ $item->stok <= 0 ? 'disabled' : '' }}
                                    class="w-full py-1.5 bg-[#f3a933] text-[#0f172a] hover:bg-[#0f172a] hover:text-white rounded-lg text-[9px] font-black uppercase tracking-wider transition duration-300 shadow-sm disabled:opacity-40 disabled:cursor-not-allowed">
                                    BOOKING
                                </button>
                            </form>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </section>
        @endforeach

    </div>

    <footer class="bg-[#0f172a] text-white py-8 mt-20 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-[10px] text-gray-500 uppercase tracking-wider">
            <p>&copy; 2026 Lenscape Team | PBL Project</p>
            <p>Server Online: Batam, ID</p>
        </div>
    </footer>

</body>

</html>