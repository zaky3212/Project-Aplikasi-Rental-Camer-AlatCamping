use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lenscape')</title>
    <link rel="icon" href="{{ asset('images/Lenscape-Logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
    @stack('styles')
</head>

@php
// Daftar route halaman yang PAKE BANNER FULL SCREEN (Nggak butuh padding top)
$hasBanner = Route::is([
'pelanggan.dashboard',
'pelanggan.Katalog.Katalog_Camera',
'pelanggan.Katalog.Katalog_Camping'
]);
@endphp


<body class="bg-gray-50 text-slate-900 overflow-x-hidden {{ $hasBanner ? '' : 'pt-24 md:pt-28' }}">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/90 backdrop-blur-lg border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center transition-all">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white z-10">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>

        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="{{ Route::is('pelanggan.dashboard') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="{{ Route::is('pelanggan.Katalog.Katalog_Camera') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="{{ Route::is('pelanggan.Katalog.Katalog_Camping') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Katalog Camping</a>
            <a href="{{ route('pelanggan.riwayat.index') }}" class="{{ Route::is('pelanggan.riwayat.*') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Riwayat Sewa</a>
            <a href="{{ route('pelanggan.profile') }}" class="{{ Route::is('pelanggan.profile') ? 'text-[#f3a933]' : 'hover:text-[#f3a933]' }} transition">Profil</a>
        </div>

        <div class="flex items-center gap-4 md:gap-6 z-10">
            <a href="{{ route('pelanggan.keranjang.index') }}" class="text-white hover:text-[#f3a933] transition relative flex items-center mt-1">
                <i class="fas fa-shopping-cart text-lg"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[8px] font-black px-1.5 py-0.5 rounded-full border border-[#0f172a]">{{ count((array) session('keranjang')) }}</span>
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

    <main>
        @yield('content')
    </main>

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
    @stack('scripts')
</body>

</html>