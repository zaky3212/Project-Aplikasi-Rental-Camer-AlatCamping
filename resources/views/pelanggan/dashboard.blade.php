<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pelanggan - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-open { overflow: hidden; }
    </style>
</head>
<body class="bg-[#f8f9fa] font-sans">

    <div class="flex min-h-screen relative">
        
        <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity duration-300"></div>

        <aside id="sidebar" class="fixed lg:sticky top-0 left-0 w-64 bg-[#0f172a] text-white flex flex-col h-screen shadow-xl z-50 transition-transform duration-300 -translate-x-full lg:translate-x-0">
            <div class="p-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold tracking-tight">
                    <span class="text-white">Lens</span><span class="text-[#f3a933]">cape</span>
                </h1>
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-0 space-y-1 overflow-y-auto">
    <a href="{{ route('pelanggan.dashboard') }}" 
       class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold 
       {{ request()->routeIs('pelanggan.dashboard') ? 'bg-[#f3a933] text-[#0f172a] shadow-lg' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}"> 
        <i class="fas fa-home w-5"></i>
        <span>Dashboard</span>
    </a>

   <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" 
   class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold
   {{ request()->routeIs('pelanggan.Katalog.Katalog_Camera') ? 'bg-[#f3a933] text-[#0f172a] shadow-lg' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
    <i class="fas fa-camera-retro w-5"></i>
    <span>Katalog Camera</span>
</a>

<a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" 
   class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold
   {{ request()->routeIs('pelanggan.Katalog.Katalog_Camping') ? 'bg-[#f3a933] text-[#0f172a] shadow-lg' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
    <i class="fas fa-campground w-5"></i>
    <span>Katalog Alat Camping</span>
</a>


    <a href="#" 
       class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold text-gray-400 hover:bg-white/5 hover:text-white">
        <i class="fas fa-history w-5"></i>
        <span>Riwayat Sewa</span>
    </a>
</nav>

            <div class="p-4 border-t border-white/5 bg-[#0f172a]">
                <div class="flex items-center space-x-3 mb-6 px-2">
                    <div class="w-10 h-10 min-w-[40px] bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] uppercase shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold truncate text-white">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider">Pelanggan Aktif</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group flex items-center justify-center space-x-2 bg-red-500/5 hover:bg-red-600 p-2.5 rounded-xl transition-all duration-300 border border-red-500/20 hover:border-red-600 shadow-sm">
                        <i class="fas fa-power-off text-red-500 group-hover:text-white transition-colors"></i>
                        <span class="text-red-500 group-hover:text-white text-xs font-bold uppercase tracking-widest">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 min-w-0 h-screen overflow-y-auto">
            
            <header class="lg:hidden bg-white border-b border-gray-100 p-4 flex justify-between items-center sticky top-0 z-30 shadow-sm">
                <h1 class="font-bold text-xl text-[#0f172a]">Lens<span class="text-[#f3a933]">cape</span></h1>
                <button onclick="toggleSidebar()" class="p-2 bg-gray-50 rounded-lg text-[#0f172a]">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <div class="p-4 md:p-8">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Dashboard Overview</h2>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">Pantau aktivitas penyewaan alat Anda hari ini.</p>
                    </div>
                    <div class="hidden sm:block text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
                        <i class="far fa-calendar-alt mr-2 text-[#f3a933]"></i> {{ date('d F Y') }}
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center space-x-4 border-l-4 border-[#f3a933]">
                        <div class="p-3 bg-[#f3a933]/10 rounded-xl text-[#f3a933]"><i class="fas fa-camera"></i></div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Sedang Disewa</p>
                            <p class="text-xl md:text-2xl font-bold">1 <span class="text-xs font-normal text-gray-400">Unit</span></p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center space-x-4 border-l-4 border-blue-400">
                        <div class="p-3 bg-blue-50 rounded-xl text-blue-600"><i class="fas fa-history"></i></div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Total Riwayat</p>
                            <p class="text-xl md:text-2xl font-bold">4</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm flex items-center space-x-4 border-l-4 border-emerald-400">
                        <div class="p-3 bg-emerald-50 rounded-xl text-emerald-600"><i class="fas fa-check-circle"></i></div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Status Akun</p>
                            <p class="text-sm font-bold text-emerald-600 uppercase">Terverifikasi</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <div class="flex justify-between items-center mb-6 border-b border-gray-50 pb-4">
                                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-user-circle text-[#f3a933]"></i> Profil Saya
                                </h3>
                                <button class="text-[10px] font-bold text-blue-500 hover:underline uppercase">Ubah Data</button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Nama Lengkap</p>
                                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Alamat Email</p>
                                        <p class="text-sm font-bold text-gray-800">{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">Nomor HP</p>
                                        <p class="text-sm font-bold text-gray-800">0812-3456-7890</p>
                                    </div>
                                    <div>
                                        <p class="text-[10px] text-gray-500 uppercase font-bold tracking-widest">ID Pelanggan</p>
                                        <p class="text-sm font-bold text-gray-800">#CS-0{{ Auth::user()->id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="p-6 flex justify-between items-center">
                                <h3 class="font-bold text-gray-800">Aktivitas Terakhir</h3>
                                <a href="#" class="text-[10px] text-[#f3a933] font-bold uppercase hover:underline">Lihat Semua</a>
                            </div>
                            <div class="overflow-x-auto px-6 pb-6">
                                <div class="space-y-3">
                                    @foreach([['Selesai', 'emerald', 'Kamera Canon EOS'], ['Proses', 'blue', 'Tenda Dome'], ['Selesai', 'emerald', 'Tripod Vinten']] as $act)
                                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition border border-transparent hover:border-gray-200">
                                        <div class="flex items-center space-x-4">
                                            <span class="px-2 py-1 bg-{{ $act[1] }}-100 text-{{ $act[1] }}-600 text-[9px] rounded-lg font-bold uppercase">{{ $act[0] }}</span>
                                            <p class="text-xs text-gray-700">Berhasil menyewa <strong>{{ $act[2] }}</strong></p>
                                        </div>
                                        <span class="text-[10px] text-gray-400 italic">2 Jam lalu</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <h3 class="font-bold text-gray-800 mb-4 text-sm flex items-center gap-2">
                                <i class="fas fa-bolt text-[#f3a933]"></i> Akses Cepat
                            </h3>
                            <div class="grid grid-cols-1 gap-3">
                                <button class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-[#f3a933]/5 hover:border-[#f3a933]/30 border border-gray-100 rounded-xl text-xs font-bold transition">
                                    Sewa Alat Baru <i class="fas fa-plus-circle text-gray-300"></i>
                                </button>
                                <button class="w-full flex justify-between items-center p-4 bg-gray-50 hover:bg-blue-50 hover:border-blue-100 border border-gray-100 rounded-xl text-xs font-bold transition text-blue-600">
                                    Panduan Sewa <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>

                        <div class="bg-[#0f172a] p-6 rounded-2xl shadow-lg text-white relative overflow-hidden group border border-white/5">
                            <div class="flex items-center justify-between mb-4 relative z-10">
                                <h3 class="font-bold text-xs uppercase tracking-widest text-gray-400">Status Layanan</h3>
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                            </div>
                            <p class="text-[10px] text-gray-400 leading-relaxed relative z-10 italic">Aplikasi Lenscape siap digunakan. Server dalam kondisi prima.</p>
                            <div class="mt-6 pt-4 border-t border-white/5 text-[9px] font-mono text-gray-500 relative z-10 flex justify-between">
                                <span>PBL IT TEAM</span>
                                <span>Ver. 1.0.4</span>
                            </div>
                            <i class="fas fa-shield-halved absolute -bottom-4 -right-4 text-white/5 text-6xl group-hover:rotate-12 transition duration-500"></i>
                        </div>
                    </div>
                </div>

                <footer class="mt-12 pb-8 text-center text-[10px] text-gray-400 uppercase tracking-widest">
                    <p>&copy; {{ date('Y') }} Lenscape - Project Based Learning</p>
                </footer>
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('sidebar-open');
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('sidebar-open');
            }
        }
    </script>
</body>
</html>