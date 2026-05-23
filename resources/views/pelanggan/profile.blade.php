<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-open { overflow: hidden; }
    </style>
</head>
<body class="bg-[#f8f9fa] font-sans">

    <div class="flex min-h-screen relative">
        
        <!-- Sidebar Overlay (Mobile) -->
        <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity duration-300"></div>

        <!-- Sidebar -->
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
                   class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold text-gray-400 hover:bg-white/5 hover:text-white"> 
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" 
                   class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold text-gray-400 hover:bg-white/5 hover:text-white">
                    <i class="fas fa-camera-retro w-5"></i>
                    <span>Katalog Camera</span>
                </a>

                <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" 
                   class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold text-gray-400 hover:bg-white/5 hover:text-white">
                    <i class="fas fa-campground w-5"></i>
                    <span>Katalog Alat Camping</span>
                </a>

                <a href="{{ route('pelanggan.penyewaan') }}" 
                   class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold text-gray-400 hover:bg-white/5 hover:text-white"> 
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span>Sewa Alat</span>
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

        <!-- Main Content -->
        <main class="flex-1 min-w-0 h-screen overflow-y-auto">
            
            <!-- Header Mobile -->
            <header class="lg:hidden bg-white border-b border-gray-100 p-4 flex justify-between items-center sticky top-0 z-30 shadow-sm">
                <h1 class="font-bold text-xl text-[#0f172a]">Lens<span class="text-[#f3a933]">cape</span></h1>
                <button onclick="toggleSidebar()" class="p-2 bg-gray-50 rounded-lg text-[#0f172a]">
                    <i class="fas fa-bars"></i>
                </button>
            </header>

            <!-- Isi Konten Profil -->
            <div class="p-4 md:p-8 max-w-5xl mx-auto">
                <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-8">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Pengaturan Profil</h2>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">Kelola informasi data diri dan keamanan akun Anda.</p>
                    </div>
                </div>

                <!-- Notifikasi Sukses Update (Bawaan Laravel Profile) -->
                @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    <p class="font-medium text-sm">Pembaruan berhasil disimpan!</p>
                </div>
                @endif

                <div class="space-y-6">
                    
                    <!-- Form Ubah Data Diri -->
                    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                        <div class="mb-6 border-b border-gray-50 pb-4">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg">
                                <i class="fas fa-user-edit text-[#f3a933]"></i> Informasi Dasar
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">Perbarui nama lengkap dan alamat email akun Anda.</p>
                        </div>

                        <!-- Form ini mengarah ke route default Laravel Breeze (profile.update) -->
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-5 max-w-2xl">
                            @csrf
                            @method('patch')

                            <div>
                                <label for="name" class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Nama Lengkap</label>
                                <input id="name" name="name" type="text" value="{{ old('name', Auth::user()->name) }}" required autofocus autocomplete="name" 
                                       class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] focus:ring-2 focus:ring-[#f3a933]/20 outline-none transition-all text-sm text-gray-800 font-medium">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Alamat Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="username"
                                       class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] focus:ring-2 focus:ring-[#f3a933]/20 outline-none transition-all text-sm text-gray-800 font-medium">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pt-4 flex items-center gap-4">
                                <button type="submit" class="bg-[#0f172a] hover:bg-gray-800 text-white px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-[10px] md:text-xs transition-all shadow-md flex items-center gap-2">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Form Ubah Password -->
                    <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                        <div class="mb-6 border-b border-gray-50 pb-4">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg">
                                <i class="fas fa-lock text-[#f3a933]"></i> Keamanan Kata Sandi
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.</p>
                        </div>

                        <!-- Form ini mengarah ke route default Laravel Breeze (password.update) -->
                        <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-2xl">
                            @csrf
                            @method('put')

                            <div>
                                <label for="update_password_current_password" class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Kata Sandi Saat Ini</label>
                                <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                                       class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] focus:ring-2 focus:ring-[#f3a933]/20 outline-none transition-all text-sm text-gray-800">
                                @error('current_password', 'updatePassword')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label for="update_password_password" class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Kata Sandi Baru</label>
                                    <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] focus:ring-2 focus:ring-[#f3a933]/20 outline-none transition-all text-sm text-gray-800">
                                    @error('password', 'updatePassword')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="update_password_password_confirmation" class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Konfirmasi Sandi Baru</label>
                                    <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] focus:ring-2 focus:ring-[#f3a933]/20 outline-none transition-all text-sm text-gray-800">
                                    @error('password_confirmation', 'updatePassword')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="pt-4 flex items-center gap-4">
                                <button type="submit" class="bg-[#f3a933] hover:bg-[#d98e1d] text-[#0f172a] px-6 py-2.5 rounded-xl font-black uppercase tracking-widest text-[10px] md:text-xs transition-all shadow-md flex items-center gap-2">
                                    <i class="fas fa-key"></i> Perbarui Sandi
                                </button>
                            </div>
                        </form>
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