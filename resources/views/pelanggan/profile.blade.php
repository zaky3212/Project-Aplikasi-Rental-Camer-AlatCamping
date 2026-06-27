<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - Lenscape</title>
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

<body class="bg-gray-50 pt-24">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/90 backdrop-blur-lg border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center transition-all">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>

        <div class="hidden lg:flex items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="hover:text-[#f3a933] transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="hover:text-[#f3a933] transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="hover:text-[#f3a933] transition">Katalog Camping</a>
            <a href="{{ route('pelanggan.riwayat.index') }}" class="hover:text-[#f3a933] transition">Riwayat Sewa</a>
            <a href="{{ route('pelanggan.profile') }}" class="text-[#f3a933] transition">Profil</a>
        </div>

        <div class="flex items-center gap-4 z-10">
            <div class="relative flex items-center gap-3">
                <span class="text-white text-xs hidden md:block uppercase tracking-wider font-medium">{{ Auth::user()->name }}</span>
                <div id="profileMenuButton" class="w-10 h-10 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] text-sm cursor-pointer hover:opacity-90 transition">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div id="profileDropdown" class="hidden absolute right-0 top-full mt-3 w-48 bg-[#0f172a] border border-white/10 rounded-2xl p-3 shadow-2xl">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center space-x-2 bg-red-500/10 hover:bg-red-600 p-2 rounded-xl border border-red-500/20 text-red-500 hover:text-white transition-all">
                            <i class="fas fa-power-off text-xs"></i>
                            <span class="text-xs font-bold uppercase tracking-widest">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Pengaturan Profil</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi data diri dan keamanan akun Anda.</p>
        </div>

        @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
        <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
            <i class="fas fa-check-circle"></i>
            <p class="font-medium text-sm">Pembaruan berhasil disimpan!</p>
        </div>
        @endif

        <div class="space-y-6">
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg mb-6"><i class="fas fa-user-edit text-[#f3a933]"></i> Informasi Dasar</h3>
                <form method="post" action="{{ route('profile.update') }}" class="space-y-5 max-w-2xl">
                    @csrf @method('patch')
                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Nama Lengkap</label>
                        <input name="name" type="text" value="{{ old('name', Auth::user()->name) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Alamat Email</label>
                        <input name="email" type="email" value="{{ old('email', Auth::user()->email) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm">
                    </div>
                    <button type="submit" class="bg-[#0f172a] text-white px-6 py-2.5 rounded-xl font-bold uppercase text-xs hover:bg-[#f3a933] transition">Simpan Perubahan</button>
                </form>
            </div>

            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg mb-6"><i class="fas fa-lock text-[#f3a933]"></i> Keamanan Kata Sandi</h3>
                <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-2xl">
                    @csrf @method('put')
                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Kata Sandi Saat Ini</label>
                        <input name="current_password" type="password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm">
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Kata Sandi Baru</label>
                            <input name="password" type="password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm">
                        </div>
                        <div>
                            <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Konfirmasi Sandi Baru</label>
                            <input name="password_confirmation" type="password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm">
                        </div>
                    </div>
                    <button type="submit" class="bg-[#f3a933] text-[#0f172a] px-6 py-2.5 rounded-xl font-bold uppercase text-xs hover:bg-yellow-600 transition">Perbarui Sandi</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        const profileMenuButton = document.getElementById('profileMenuButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', () => profileDropdown.classList.add('hidden'));
    </script>
</body>

</html>