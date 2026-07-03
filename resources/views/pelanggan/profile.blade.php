@extends('layouts.pelanggan')

@section('title', 'Profil Saya - Lenscape')

@section('content')
<main class="max-w-4xl mx-auto px-4 py-8 md:py-12">

    <!-- HEADER PROFIL -->
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Pengaturan Profil</h2>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi data diri dan keamanan akun Anda.</p>
    </div>

    <!-- NOTIFIKASI BERHASIL -->
    @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        <p class="font-medium text-sm">Pembaruan berhasil disimpan!</p>
    </div>
    @endif

    <div class="space-y-6">

        <!-- FORM INFORMASI DASAR -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg mb-6">
                <i class="fas fa-user-edit text-[#f3a933]"></i> Informasi Dasar
            </h3>

            <form method="post" action="{{ route('profile.update') }}" class="space-y-5 max-w-2xl">
                @csrf @method('patch')
                <div>
                    <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Nama Lengkap</label>
                    <input name="name" type="text" value="{{ old('name', Auth::user()->name) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm transition-colors">
                </div>
                <div>
                    <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Alamat Email</label>
                    <input name="email" type="email" value="{{ old('email', Auth::user()->email) }}" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm transition-colors">
                </div>
                <button type="submit" class="bg-[#0f172a] text-white px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-[#f3a933] hover:text-[#0f172a] transition-all shadow-md">
                    Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- FORM KEAMANAN KATA SANDI -->
        <div class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 flex items-center gap-2 text-lg mb-6">
                <i class="fas fa-lock text-[#f3a933]"></i> Keamanan Kata Sandi
            </h3>

            <form method="post" action="{{ route('password.update') }}" class="space-y-5 max-w-2xl">
                @csrf @method('put')
                <div>
                    <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Kata Sandi Saat Ini</label>
                    <input name="current_password" type="password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm transition-colors">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Kata Sandi Baru</label>
                        <input name="password" type="password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm transition-colors">
                    </div>
                    <div>
                        <label class="block text-[10px] text-gray-500 uppercase font-bold tracking-widest mb-2">Konfirmasi Sandi Baru</label>
                        <input name="password_confirmation" type="password" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#f3a933] outline-none text-sm transition-colors">
                    </div>
                </div>
                <button type="submit" class="bg-[#f3a933] text-[#0f172a] px-6 py-2.5 rounded-xl font-bold uppercase tracking-widest text-xs hover:bg-yellow-600 transition-all shadow-md">
                    Perbarui Sandi
                </button>
            </form>
        </div>

    </div>
</main>
@endsection