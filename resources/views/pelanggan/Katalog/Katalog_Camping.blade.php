<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat Camping - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-slate-900 overflow-x-hidden pt-24">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/90 backdrop-blur-lg border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center transition-all">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white z-10">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>
        
        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="{{ Route::is('pelanggan.dashboard') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="{{ Route::is('pelanggan.Katalog.Katalog_Camera') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="{{ Route::is('pelanggan.Katalog.Katalog_Camping') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Katalog Camping</a>
            <a href="{{ route('pelanggan.riwayat.index') }}"
                class="{{ Route::is('pelanggan.riwayat.*') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">
                Riwayat Sewa
            </a>
            <a href="{{ route('pelanggan.profile') }}" class="{{ Route::is('pelanggan.profile') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Profil</a>
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

                <div id="profileDropdown" class="hidden absolute right-0 top-full mt-3 w-48 bg-[#0f172a] border border-white/10 rounded-2xl p-3 shadow-2xl z-50">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full group flex items-center justify-center space-x-2 bg-red-500/5 hover:bg-red-600 p-2.5 rounded-xl transition-all duration-300 border border-red-500/20 hover:border-red-600 shadow-sm">
                            <i class="fas fa-power-off text-red-500 group-hover:text-white transition-colors"></i>
                            <span class="text-red-500 group-hover:text-white text-xs font-bold uppercase tracking-widest">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>

            <button id="btnMobileMenu" class="lg:hidden text-white text-xl hover:text-[#f3a933] transition">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <section class="relative h-[60vh] md:h-[450px] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?q=80&w=1638&auto=format&fit=crop" class="w-full h-full object-cover brightness-[0.4]" alt="Banner Camping">
        <div class="absolute inset-0 flex items-center px-6 md:px-20">
            <div class="text-white mt-10 md:mt-12 w-full">
                <div class="inline-block px-3 py-1 bg-[#f3a933]/20 border border-[#f3a933]/30 rounded-full text-[#f3a933] text-[9px] md:text-[10px] font-bold uppercase tracking-widest mb-4">
                    Adventure Ready
                </div>
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-extrabold leading-tight">Perlengkapan<br><span class="text-[#f3a933]">Alat Camping</span></h1>
                <p class="mt-4 text-gray-300 max-w-lg text-xs md:text-base leading-relaxed opacity-90">Siapkan petualangan Anda dengan perlengkapan outdoor premium. Tangguh di segala medan, nyaman di setiap pendakian.</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-20 space-y-16 md:space-y-24">
        
        @foreach($categories as $cat)
        <section>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 md:mb-10 gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-3 md:gap-4">
                        <span class="p-2 md:p-3 bg-white shadow-sm rounded-xl md:rounded-2xl text-[#f3a933]">
                            <i class="fas {{ Str::contains(strtolower($cat->nama_kategori), 'tenda') ? 'fa-campground' : 'fa-mountain' }} fa-fw"></i>
                        </span>
                        {{ $cat->nama_kategori }}
                    </h2>
                    <div class="h-1 w-16 md:w-20 bg-[#f3a933] mt-3 rounded-full"></div>
                </div>
                <a href="{{ route('pelanggan.Katalog.Katalog_Camping.semua') }}" class="text-gray-400 hover:text-[#f3a933] transition-colors flex items-center gap-2 text-[10px] md:text-sm font-bold uppercase tracking-wider">
                    Lihat Semua <i class="fas fa-chevron-right text-[10px]"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-8">
                @foreach($cat->barang as $item)
                <div class="bg-white rounded-[1.5rem] md:rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 overflow-hidden group relative flex flex-col">
                    
                    <div class="absolute top-3 right-3 md:top-4 md:right-4 z-10">
                        @if($item->stok > 0)
                            <span class="px-2 md:px-3 py-1 bg-emerald-500 text-white text-[8px] md:text-[9px] font-black uppercase rounded-full shadow-md">Tersedia</span>
                        @else
                            <span class="px-2 md:px-3 py-1 bg-red-500 text-white text-[8px] md:text-[9px] font-black uppercase rounded-full shadow-md">Habis</span>
                        @endif
                    </div>

                    <a href="{{ route('pelanggan.Katalog.detail_barang', $item->id) }}" class="block flex-grow flex flex-col">
                        
                        <div class="aspect-square bg-gray-50 p-4 md:p-6 flex items-center justify-center relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-200/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            @if($item->gambar)
                                <img src="{{ asset($item->gambar) }}" 
                                     class="max-h-full object-contain transition-transform duration-700 group-hover:scale-110" 
                                     alt="{{ $item->nama }}">
                            @else
                                <div class="text-center text-gray-300">
                                    <i class="fas fa-campground text-4xl mb-1 block"></i>
                                    <span class="text-[10px] font-semibold text-gray-400">No Image</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-4 md:p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <p class="text-[8px] md:text-[10px] text-[#f3a933] font-black uppercase tracking-[0.2em] mb-1">
                                    {{ $item->merk }}
                                </p>
                                <h3 class="font-bold text-gray-800 text-sm md:text-base truncate group-hover:text-[#f3a933] transition-colors mb-2" title="{{ $item->nama }}">
                                    {{ $item->nama }}
                                </h3>
                            </div>
                        </div>
                    </a>

                    <div class="px-4 pb-4 md:px-6 md:pb-6">
                        <div class="pt-4 border-t border-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex flex-col">
                                    <span class="text-[8px] md:text-[9px] text-gray-400 uppercase font-bold">Sewa</span>
                                    <span class="text-xs md:text-sm font-black text-gray-900">
                                        Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}<span class="text-[9px] md:text-[10px] text-gray-400 font-normal">/hari</span>
                                    </span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[8px] md:text-[9px] text-gray-400 uppercase font-bold block">Stok</span>
                                    <span class="text-[10px] md:text-xs font-bold text-gray-700">{{ $item->stok }} Pcs</span>
                                </div>
                            </div>
                            
                            <form action="{{ route('pelanggan.keranjang.index') }}" method="GET">
                                <button type="submit" {{ $item->stok <= 0 ? 'disabled' : '' }}
                                    class="w-full py-2.5 md:py-3 bg-[#0f172a] text-white rounded-lg md:rounded-xl text-[9px] md:text-[10px] font-black uppercase tracking-widest hover:bg-[#f3a933] hover:text-[#0f172a] transition-all duration-300 shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                                    <i class="fas fa-calendar-plus mr-1 md:mr-2"></i> Booking
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
        </section>
        @endforeach
    </div>

    <footer class="bg-[#0f172a] text-white py-12 md:py-16 mt-20">
        <div class="max-w-7xl mx-auto px-6 md:px-8">
            <div class="flex flex-col lg:flex-row justify-between items-center lg:items-start gap-10 border-b border-white/5 pb-12 mb-12 text-center lg:text-left">
                <div>
                    <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight">Lens<span class="text-[#f3a933]">cape</span></h2>
                    <p class="text-gray-500 text-xs md:text-sm mt-2">Penyedia jasa rental kamera & camping equipment terpercaya.</p>
                </div>
                <div class="flex flex-wrap justify-center gap-6 md:gap-8 text-gray-400 text-[10px] md:text-xs font-bold uppercase tracking-widest">
                    <a href="#" class="hover:text-[#f3a933] transition">Kebijakan</a>
                    <a href="#" class="hover:text-[#f3a933] transition">Syarat</a>
                    <a href="#" class="hover:text-[#f3a933] transition">Bantuan</a>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-[8px] md:text-[10px] text-gray-500 uppercase tracking-[0.2em] text-center">
                <p>&copy; 2026 Lenscape Team | PBL Informatics</p>
                <p class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> 
                    Server Online: Batam, ID
                </p>
            </div>
        </div>
    </footer>

    <script>
        const profileMenuButton = document.getElementById('profileMenuButton');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileMenuButton && profileDropdown) {
            profileMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });

            document.addEventListener('click', (e) => {
                if (!profileMenuButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                    profileDropdown.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>