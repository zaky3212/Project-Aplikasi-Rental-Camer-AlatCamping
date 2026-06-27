<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lenscape - Dashboard Admin')</title>
    <link rel="icon" href="{{ asset('images/Lenscape-Logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-[#f8f9fa] font-sans">

    <div class="flex min-h-screen relative">
        <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden"></div>

        <aside id="sidebar" class="fixed lg:sticky top-0 left-0 z-30 w-64 bg-[#0f172a] text-white flex flex-col h-screen -translate-x-full lg:translate-x-0">
            <div class="p-6 flex justify-between items-center">
                <h1 class="text-2xl font-bold tracking-tight">
                    <span class="text-white">Lens</span><span class="text-[#f3a933]">cape</span>
                </h1>
                <button onclick="toggleSidebar()" class="lg:hidden text-gray-400 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-0 space-y-1 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-4 transition {{ Route::is('admin.dashboard') ? 'bg-[#f3a933] text-[#0f172a] rounded-r-full mr-4 font-semibold shadow-lg' : 'hover:bg-white/5 text-gray-400' }}">
                    <i class="fas fa-home w-5"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="flex items-center space-x-3 p-4 transition {{ Route::is('admin.kategori.*') ? 'bg-[#f3a933] text-[#0f172a] rounded-r-full mr-4 font-semibold shadow-lg' : 'hover:bg-white/5 text-gray-400' }}">
                    <i class="fas fa-list w-5"></i><span>Kategori</span>
                </a>
                <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-3 p-4 transition {{ Route::is('admin.barang.*') ? 'bg-[#f3a933] text-[#0f172a] rounded-r-full mr-4 font-semibold shadow-lg' : 'hover:bg-white/5 text-gray-400' }}">
                    <i class="fas fa-box w-5"></i><span>Barang</span>
                </a>
                <a href="{{ route('admin.penyewaan.index') }}" class="flex items-center space-x-3 p-4 transition {{ Route::is('admin.penyewaan.*') ? 'bg-[#f3a933] text-[#0f172a] rounded-r-full mr-4 font-semibold shadow-lg' : 'hover:bg-white/5 text-gray-400' }}">
                    <i class="fas fa-file-invoice w-5"></i><span>Penyewaan</span>
                </a>
                <a href="{{ route('admin.user.index') }}" class="flex items-center space-x-3 p-4 transition {{ Route::is('admin.user.*') ? 'bg-[#f3a933] text-[#0f172a] rounded-r-full mr-4 font-semibold shadow-lg' : 'hover:bg-white/5 text-gray-400' }}">
                    <i class="fas fa-user-cog w-5"></i><span>Kelola User</span> </a>
            </nav>

            <div class="p-4 border-t border-white/5 bg-[#0f172a]">
                <div class="flex items-center space-x-3 mb-6 px-2">
                    <div class="w-10 h-10 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] uppercase shadow-md flex-shrink-0">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider">Administrator</p>
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

        <main class="flex-1 w-full p-4 md:p-8 overflow-x-hidden flex flex-col">
            <div class="flex lg:hidden justify-between items-center mb-6 bg-white p-4 rounded-xl shadow-sm">
                <h1 class="text-xl font-bold text-[#0f172a]">Lenscape</h1>
                <button onclick="toggleSidebar()" class="p-2 bg-gray-100 rounded-lg text-[#0f172a]">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="flex-1">
                @yield('content')
            </div>

            <footer class="mt-auto pt-8 pb-4 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] text-gray-400 text-center">
                <p>&copy; {{ date('Y') }} Lenscape - Rental Management System</p>
                <p>Server Time: {{ now()->toDateTimeString() }}</p>
            </footer>
        </main>
    </div>

    {{-- PERBAIKAN UTAMA: Tempat merender tumpukan kode HTML Modal dari child-view --}}
    @stack('modals')

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            } else {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
    @stack('scripts')
</body>

</html>