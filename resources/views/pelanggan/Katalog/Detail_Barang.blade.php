<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail {{ $barang->nama }} - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 font-sans overflow-x-hidden pt-24">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/90 backdrop-blur-lg border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center transition-all">
        @php
    $isCamping = Str::contains(Str::lower($barang->kategori->nama_kategori), ['camping', 'tenda']);
    $backRoute = $isCamping ? route('pelanggan.Katalog.Katalog_Camping.semua') : route('pelanggan.Katalog.Katalog_Camera.semua');
@endphp

        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white z-10">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>
        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="hover:text-[#f3a933] transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="hover:text-[#f3a933] transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="hover:text-[#f3a933] transition">Katalog Camping</a>
            <a href="#" class="hover:text-[#f3a933] transition">Riwayat Sewa</a>
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

    <div class="max-w-5xl mx-auto px-4 md:px-6 py-8">
        
        @php
            $isCamping = Str::contains(Str::lower($barang->kategori->nama_kategori), ['camping', 'tenda']);
            $backRoute = $isCamping ? route('pelanggan.Katalog.Katalog_Camping.semua') : route('pelanggan.Katalog.Katalog_Camera.semua');
            $categoryName = $isCamping ? 'Perlengkapan Camping' : 'Perlengkapan Kamera';
        @endphp

        <div class="flex items-center gap-3 mb-8">
            <a href="{{ $backRoute }}" 
               class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-[#0f172a] hover:text-white hover:border-[#0f172a] transition duration-300 shadow-sm group">
                <i class="fas fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i>
            </a>
            <div class="text-xs md:text-sm text-gray-400 font-medium">
                <a href="{{ $backRoute }}" class="hover:text-[#f3a933] transition">{{ $categoryName }}</a>
                <span class="mx-2">/</span>
                <span class="text-gray-700 font-semibold">{{ $barang->nama }}</span>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden p-6 md:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                
                <div class="flex flex-col justify-center items-center bg-gray-50/50 rounded-2xl p-6 border border-gray-100 relative aspect-square w-full max-h-[400px]">
                    <div class="absolute top-4 left-4">
                        @if($barang->stok > 0)
                            <span class="px-3 py-1 bg-emerald-500 text-white text-[9px] font-black uppercase rounded-full shadow">Tersedia</span>
                        @else
                            <span class="px-3 py-1 bg-red-500 text-white text-[9px] font-black uppercase rounded-full shadow">Stok Habis</span>
                        @endif
                    </div>

                    @if($barang->gambar)
                        <img src="{{ asset($barang->gambar) }}" class="max-h-full max-w-full object-contain rounded-xl" alt="{{ $barang->nama }}">
                    @else
                        <div class="text-center text-gray-300">
                            <i class="fas {{ $isCamping ? 'fa-campground' : 'fa-camera' }} text-6xl mb-2"></i>
                            <span class="text-xs font-medium text-gray-400 block">Gambar tidak tersedia</span>
                        </div>
                    @endif
                </div>

                <div class="flex flex-col justify-between space-y-6">
                    <div class="space-y-3">
                        <span class="px-2.5 py-1 bg-[#f3a933]/10 text-[#f3a933] text-[10px] font-bold uppercase tracking-wider rounded-md inline-block">
                            {{ $barang->merk }}
                        </span>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight leading-tight">
                            {{ $barang->nama }}
                        </h1>
                        <p class="text-xs text-gray-400 font-medium">Kategori: <span class="text-gray-600">{{ $barang->kategori->nama_kategori }}</span></p>
                        
                        <div class="h-[1px] w-full bg-gray-100 my-4"></div>
                        
                        <div class="space-y-2">
                            <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider">Deskripsi Perangkat</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">
                                {{ $barang->deskripsi ?? 'Tidak ada deskripsi tambahan mengenai perlengkapan ini. Silakan hubungi pihak admin Manpro Lenscape jika memerlukan spesifikasi mendalam.' }}
                            </p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-2xl p-4 md:p-6 border border-gray-100 space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Harga Sewa</span>
                                <span class="text-xl md:text-2xl font-black text-[#0f172a]">
                                    Rp {{ number_format($barang->harga_sewa, 0, ',', '.') }}<span class="text-xs text-gray-400 font-normal"> / Hari</span>
                                </span>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Sisa Stok</span>
                                <span class="text-sm font-bold text-gray-700">{{ $barang->stok }} Unit</span>
                            </div>
                        </div>

                        <form action="{{ route('pelanggan.keranjang.index') }}" method="GET">
                            <button type="submit" {{ $barang->stok <= 0 ? 'disabled' : '' }} 
                                class="w-full py-3.5 bg-[#f3a933] text-[#0f172a] hover:bg-[#0f172a] hover:text-white rounded-xl text-xs font-black uppercase tracking-wider transition duration-300 shadow-md disabled:opacity-40 disabled:cursor-not-allowed">
                                <i class="fas fa-shopping-bag mr-2"></i> Masukkan Keranjang (Booking)
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <footer class="bg-[#0f172a] text-white py-8 mt-20 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row justify-between items-center gap-4 text-[10px] text-gray-500 uppercase tracking-wider">
            <p>&copy; 2026 Lenscape Team | PBL Project</p>
            <p>Server Online: Batam, ID</p>
        </div>
    </footer>

</body>
</html>