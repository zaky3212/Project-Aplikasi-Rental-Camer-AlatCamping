<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Alat - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/80 backdrop-blur-md border-b border-white/10 py-4 px-6 md:px-12 flex justify-between items-center transition-all duration-300">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-2xl font-bold tracking-tight text-white">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>
        
        <div class="flex items-center gap-6">
            <a href="{{ route('pelanggan.dashboard') }}" class="text-white hover:text-[#f3a933] text-sm font-semibold transition flex items-center gap-2">
                <i class="fas fa-arrow-left text-xs"></i> Kembali ke Dashboard
            </a>
            <div class="h-6 w-[1px] bg-white/20"></div>
            <div class="flex items-center gap-3">
                <span class="text-white text-xs hidden md:block">{{ Auth::user()->name }}</span>
                <div class="w-8 h-8 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] text-xs">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <section class="relative h-[450px] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?q=80&w=1638&auto=format&fit=crop" class="w-full h-full object-cover brightness-[0.4]" alt="Banner Lenscape">
        <div class="absolute inset-0 flex items-center px-6 md:px-20">
            <div class="text-white mt-12">
                <div class="inline-block px-3 py-1 bg-[#f3a933]/20 border border-[#f3a933]/30 rounded-full text-[#f3a933] text-[10px] font-bold uppercase tracking-widest mb-4">
                    Koleksi Profesional
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">Perlengkapan<br><span class="text-[#f3a933]">Kamera</span></h1>
                <p class="mt-4 text-gray-300 max-w-lg text-sm md:text-base leading-relaxed">Pilih perangkat kamera terbaik untuk menangkap setiap momen berharga Anda. Tersedia berbagai tipe mulai dari DSLR hingga Mirrorless terbaru.</p>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 py-20 space-y-24">
        
        @foreach($categories as $cat)
        <section>
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 flex items-center gap-4">
                        <span class="p-3 bg-white shadow-sm rounded-2xl text-[#f3a933]">
                            <i class="fas {{ $cat['icon'] }}"></i>
                        </span>
                        {{ $cat['name'] }}
                    </h2>
                    <div class="h-1 w-20 bg-[#f3a933] mt-3 rounded-full"></div>
                </div>
                <button class="text-gray-400 hover:text-[#f3a933] transition-colors flex items-center gap-2 text-sm font-bold uppercase tracking-wider">
                    Lihat Semua <i class="fas fa-chevron-right text-xs"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-5 gap-8">
                @for($i = 0; $i < 5; $i++)
                <div class="bg-white rounded-[2rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 overflow-hidden group relative">
                    <div class="absolute top-4 right-4 z-10">
                        <span class="px-3 py-1 bg-emerald-500 text-white text-[9px] font-black uppercase rounded-full shadow-lg">Tersedia</span>
                    </div>

                    <div class="aspect-square bg-gray-50 p-6 flex items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-200/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=400" 
                             class="max-h-full object-contain transition-transform duration-700 group-hover:scale-110 group-hover:rotate-3" alt="Alat">
                    </div>

                    <div class="p-6">
                        <p class="text-[10px] text-[#f3a933] font-black uppercase tracking-[0.2em] mb-1">Sony Pro Series</p>
                        <h3 class="font-bold text-gray-800 text-base truncate group-hover:text-[#f3a933] transition-colors">Alpha A7 Mark III</h3>
                        
                        <div class="mt-5 pt-5 border-t border-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex flex-col">
                                    <span class="text-[9px] text-gray-400 uppercase font-bold">Harga Sewa</span>
                                    <span class="text-sm font-black text-gray-900">Rp 25.000<span class="text-[10px] text-gray-400 font-normal">/Hari</span></span>
                                </div>
                                <div class="text-right">
                                    <span class="text-[9px] text-gray-400 uppercase font-bold block">Stok</span>
                                    <span class="text-xs font-bold text-gray-700">12 Unit</span>
                                </div>
                            </div>
                            
                            <button class="w-full py-3 bg-[#0f172a] text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#f3a933] hover:text-[#0f172a] transition-all duration-300 shadow-lg shadow-gray-200">
                                <i class="fas fa-calendar-plus mr-2"></i> Booking Sekarang
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </section>
        @endforeach

    </div>

    <footer class="bg-[#0f172a] text-white py-16 mt-20">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 border-b border-white/5 pb-12 mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight">Lens<span class="text-[#f3a933]">cape</span></h2>
                    <p class="text-gray-500 text-sm mt-2">Penyedia jasa rental kamera & camping equipment terpercaya.</p>
                </div>
                <div class="flex gap-8 text-gray-400 text-xs font-bold uppercase tracking-widest">
                    <a href="#" class="hover:text-[#f3a933] transition">Kebijakan</a>
                    <a href="#" class="hover:text-[#f3a933] transition">Syarat</a>
                    <a href="#" class="hover:text-[#f3a933] transition">Bantuan</a>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-gray-500 uppercase tracking-[0.2em]">
                <p>&copy; 2026 Lenscape Team | PBL Project Informatics</p>
                <p class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> 
                    Server Time: {{ date('Y-m-d H:i:s') }}
                </p>
            </div>
        </div>
    </footer>

</body>
</html>