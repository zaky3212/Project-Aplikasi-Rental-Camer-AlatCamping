<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Pelanggan - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-slate-900 overflow-x-hidden">

    <!-- ================= NAVBAR ================= -->
    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/90 backdrop-blur-lg border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center transition-all">
        
        <!-- Kiri: Logo -->
        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white z-10">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>
        
        <!-- Tengah: Menu Navigasi (Sembunyi di HP, Tampil di Laptop) -->
        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="text-[#f3a933] transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="hover:text-[#f3a933] transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="hover:text-[#f3a933] transition">Katalog Camping</a>
            <a href="#" class="hover:text-[#f3a933] transition">Riwayat Sewa</a>
            <a href="{{ route('pelanggan.profile') }}" class="hover:text-[#f3a933] transition">Profil</a>
        </div>
        
        <!-- Kanan: Keranjang & Akun -->
        <div class="flex items-center gap-4 md:gap-6 z-10">
            
            <!-- Icon Keranjang -->
            <a href="{{ route('pelanggan.keranjang.index') }}" class="text-white hover:text-[#f3a933] transition relative flex items-center mt-1">
                <i class="fas fa-shopping-cart text-lg"></i>
                <!-- Badge Notif Angka -->
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[8px] font-black px-1.5 py-0.5 rounded-full border border-[#0f172a]">2</span>
            </a>

            <div class="h-6 w-[1px] bg-white/20 hidden xs:block"></div>
            
            <!-- Profil Singkat -->
            <div class="flex items-center gap-2 md:gap-3">
                <span class="text-white text-[10px] md:text-xs hidden md:block uppercase tracking-wider font-medium">{{ Auth::user()->name ?? 'Pelanggan' }}</span>
                <div class="w-8 h-8 md:w-10 md:h-10 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] text-xs md:text-sm shadow-inner cursor-pointer">
                    {{ substr(Auth::user()->name ?? 'P', 0, 1) }}
                </div>
            </div>

            <!-- Tombol Hamburger Mobile -->
            <button id="btnMobileMenu" class="lg:hidden text-white text-xl hover:text-[#f3a933] transition">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <!-- ================= MOBILE MENU DROPDOWN ================= -->
    <div id="mobileMenu" class="fixed top-[60px] w-full bg-[#0f172a] border-b border-white/10 z-40 hidden flex flex-col px-6 py-6 gap-5 shadow-2xl lg:hidden">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-[#f3a933] font-bold text-sm uppercase tracking-wider">Beranda</a>
        <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Katalog Camera</a>
        <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Katalog Camping</a>
        <a href="#" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Riwayat Sewa</a>
        <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Profil</a>
    </div>

    <!-- ================= HERO SECTION ================= -->
    <section class="relative h-[60vh] md:h-[500px] mt-[60px] md:mt-[70px] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1542332213-9b5a5a3fad35?q=80&w=1638&auto=format&fit=crop" class="w-full h-full object-cover brightness-[0.4]" alt="Banner Home">
        <div class="absolute inset-0 flex items-center px-6 md:px-20 max-w-7xl mx-auto w-full">
            <div class="text-white mt-10 w-full">
                <div class="inline-block px-3 py-1 bg-[#f3a933]/20 border border-[#f3a933]/30 rounded-full text-[#f3a933] text-[9px] md:text-[10px] font-bold uppercase tracking-widest mb-4">
                    Pusat Rental Batam
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-7xl font-extrabold leading-tight">Mulai Petualangan<br><span class="text-[#f3a933]">Tanpa Batas</span></h1>
                <p class="mt-4 text-gray-300 max-w-lg text-xs md:text-base leading-relaxed opacity-90">Sewa perlengkapan camping dan kamera profesional dengan mudah, cepat, dan terpercaya. Kualitas terjamin untuk setiap momen epik Anda.</p>
                <div class="mt-8 flex gap-4">
                    <a href="#kamera-pilihan" class="px-6 py-3 bg-[#f3a933] text-[#0f172a] text-xs font-black uppercase tracking-widest rounded-xl hover:bg-[#d98e1d] transition shadow-lg shadow-[#f3a933]/30">Sewa Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-12 md:py-20 space-y-16 md:space-y-24">
        
        <!-- ================= HIGHLIGHT KAMERA ================= -->
        <section id="kamera-pilihan">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 md:mb-10 gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-3 md:gap-4">
                        <span class="p-2 md:p-3 bg-white shadow-sm rounded-xl md:rounded-2xl text-[#f3a933]">
                            <i class="fas fa-camera fa-fw"></i>
                        </span>
                        Kamera Pilihan
                    </h2>
                    <div class="h-1 w-16 md:w-20 bg-[#f3a933] mt-3 rounded-full"></div>
                </div>
                <!-- Tombol Lihat Lebih Banyak (Ngarah ke Katalog Kamera) -->
                <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="px-4 py-2 bg-gray-100 hover:bg-[#0f172a] hover:text-[#f3a933] text-gray-700 rounded-lg transition-colors flex items-center gap-2 text-[10px] md:text-xs font-bold uppercase tracking-wider">
                    Lihat Lebih Banyak <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Grid Dummy Barang (Cuma nampilin 4 item) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @for($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 overflow-hidden group relative flex flex-col">
                    <div class="absolute top-3 right-3 z-10">
                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 border border-emerald-200 text-[8px] font-black uppercase rounded-full shadow-sm"><i class="fas fa-star text-[7px] mr-1"></i> Sangat Baik</span>
                    </div>

                    <div class="aspect-[4/3] bg-gray-50 p-4 flex items-center justify-center relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&q=80&w=400" 
                             class="max-h-full object-contain transition-transform duration-700 group-hover:scale-110" alt="Kamera">
                    </div>

                    <div class="p-5 flex-grow flex flex-col">
                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-1">Sony</p>
                        <h3 class="font-bold text-gray-800 text-sm truncate group-hover:text-[#f3a933] transition-colors mb-3">Sony Alpha A6000</h3>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex flex-col">
                                    <span class="text-lg font-black text-[#0f172a]">Rp 150k<span class="text-[10px] text-gray-400 font-normal">/hari</span></span>
                                </div>
                            </div>
                            
                            <button class="w-full py-2.5 bg-[#f3a933] text-[#0f172a] rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#d98e1d] transition shadow-md flex justify-center items-center gap-2">
                                <i class="fas fa-cart-plus"></i> Tambah Sewa
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </section>

        <!-- ================= HIGHLIGHT CAMPING ================= -->
        <section>
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 md:mb-10 gap-4">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 flex items-center gap-3 md:gap-4">
                        <span class="p-2 md:p-3 bg-white shadow-sm rounded-xl md:rounded-2xl text-[#f3a933]">
                            <i class="fas fa-campground fa-fw"></i>
                        </span>
                        Alat Camping Favorit
                    </h2>
                    <div class="h-1 w-16 md:w-20 bg-[#f3a933] mt-3 rounded-full"></div>
                </div>
                <!-- Tombol Lihat Lebih Banyak (Ngarah ke Katalog Camping) -->
                <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="px-4 py-2 bg-gray-100 hover:bg-[#0f172a] hover:text-[#f3a933] text-gray-700 rounded-lg transition-colors flex items-center gap-2 text-[10px] md:text-xs font-bold uppercase tracking-wider">
                    Lihat Lebih Banyak <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <!-- Grid Dummy Barang -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                @for($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-[1.5rem] shadow-sm hover:shadow-xl transition-all duration-500 border border-gray-100 overflow-hidden group relative flex flex-col">
                    <div class="absolute top-3 right-3 z-10">
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 border border-blue-200 text-[8px] font-black uppercase rounded-full shadow-sm"><i class="fas fa-check text-[7px] mr-1"></i> Baik</span>
                    </div>

                    <div class="aspect-[4/3] bg-gray-50 p-4 flex items-center justify-center relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1523987355523-c7b5b0dd90a7?auto=format&fit=crop&q=80&w=400" 
                             class="max-h-full object-contain transition-transform duration-700 group-hover:scale-110" alt="Tenda">
                    </div>

                    <div class="p-5 flex-grow flex flex-col">
                        <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-1">Eiger</p>
                        <h3 class="font-bold text-gray-800 text-sm truncate group-hover:text-[#f3a933] transition-colors mb-3">Tenda Dome Kapasitas 4</h3>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex flex-col">
                                    <span class="text-lg font-black text-[#0f172a]">Rp 45k<span class="text-[10px] text-gray-400 font-normal">/hari</span></span>
                                </div>
                            </div>
                            
                            <button class="w-full py-2.5 bg-[#f3a933] text-[#0f172a] rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-[#d98e1d] transition shadow-md flex justify-center items-center gap-2">
                                <i class="fas fa-cart-plus"></i> Tambah Sewa
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </section>

    </div>

    <!-- ================= FOOTER ================= -->
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
                <p>&copy; {{ date('Y') }} Lenscape Team | PBL Informatics</p>
                <p class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span> 
                    Server Online: Batam, ID
                </p>
            </div>
        </div>
    </footer>

    <!-- SCRIPT BUAT BUKA TUTUP MENU DI HP -->
    <script>
        const btnMenu = document.getElementById('btnMobileMenu');
        const mobileMenu = document.getElementById('mobileMenu');

        btnMenu.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>