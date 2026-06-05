<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Sewa - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-slate-900 overflow-x-hidden">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a] border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center shadow-lg">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white z-10 flex items-center gap-3">
            <i class="fas fa-arrow-left text-sm text-gray-400 hover:text-[#f3a933] transition hidden md:block"></i>
            Lens<span class="text-[#f3a933]">cape</span>
        </a>

        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="hover:text-[#f3a933] transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="hover:text-[#f3a933] transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="hover:text-[#f3a933] transition">Katalog Camping</a>
            <a href="{{ route('profile.edit') }}" class="hover:text-[#f3a933] transition">Profil</a>
        </div>

        <div class="flex items-center gap-4 z-10">
            <a href="{{ route('pelanggan.keranjang.index') }}" class="text-white relative flex items-center mt-1">
                <i class="fas fa-shopping-cart text-lg text-[#f3a933]"></i>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-[8px] font-black px-1.5 py-0.5 rounded-full border border-[#0f172a]">
                    {{ count((array) session('keranjang')) }}
                </span>
            </a>
            <div class="h-6 w-[1px] bg-white/20 hidden xs:block ml-2"></div>
            <div class="flex items-center gap-2">
                <span class="text-white text-xs hidden md:block uppercase tracking-wider font-medium">{{ Auth::user()->name ?? 'Pelanggan' }}</span>
                <div class="w-8 h-8 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] text-xs shadow-inner">
                    {{ substr(Auth::user()->name ?? 'P', 0, 1) }}
                </div>
            </div>
            <button id="btnMobileMenu" class="lg:hidden text-white text-xl hover:text-[#f3a933] transition">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <div id="mobileMenu" class="fixed top-[60px] w-full bg-[#0f172a] border-b border-white/10 z-40 hidden flex flex-col px-6 py-6 gap-5 shadow-2xl lg:hidden">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Beranda</a>
        <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Katalog Camera</a>
        <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Katalog Camping</a>
        <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-[#f3a933] font-bold text-sm uppercase tracking-wider transition">Profil</a>
    </div>

    <main class="max-w-7xl mx-auto px-4 md:px-6 pt-28 pb-20">

        <div class="mb-8">
            <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 flex items-center gap-3">
                <i class="fas fa-shopping-cart text-[#f3a933]"></i> Keranjang Sewa
            </h1>
            <p class="text-sm text-gray-500 mt-2">Pastikan alat dan durasi sewa sudah sesuai sebelum melanjutkan pembayaran.</p>
        </div>

        @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl mb-6 flex items-center gap-3">
            <i class="fas fa-check-circle"></i>
            <span class="text-sm font-semibold">{{ session('success') }}</span>
        </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <div class="w-full lg:w-2/3 space-y-4">
                @forelse($keranjang as $id => $item)
                <div class="bg-white rounded-2xl p-4 md:p-5 shadow-sm border border-gray-100 flex flex-col sm:flex-row items-start sm:items-center gap-5 hover:shadow-md transition">

                    <div class="w-full sm:w-28 aspect-square bg-gray-50 rounded-xl overflow-hidden flex-shrink-0 relative border border-gray-100">
                        <img src="{{ $item['gambar'] }}" class="w-full h-full object-contain p-2" alt="{{ $item['nama'] }}">
                    </div>

                    <div class="flex-grow w-full">
                        <div class="flex justify-between items-start mb-1">
                            <span class="text-[9px] font-black uppercase tracking-widest text-[#f3a933]">{{ $item['kategori'] }}</span>
                            <form action="{{ route('pelanggan.keranjang.destroy', $id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition p-1" title="Hapus">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                        <h3 class="font-bold text-gray-800 text-base md:text-lg mb-2 line-clamp-1">{{ $item['nama'] }}</h3>
                        <p class="text-gray-900 font-black mb-4">Rp {{ number_format($item['harga_sewa'], 0, ',', '.') }}<span class="text-[10px] text-gray-400 font-normal"> / hari</span></p>

                        <div class="flex items-center gap-1 bg-gray-50 w-fit p-1 rounded-lg border border-gray-200">
                            <form action="{{ route('pelanggan.keranjang.update', $id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="action" value="minus">
                                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 hover:bg-gray-200 transition shadow-sm">
                                    <i class="fas fa-minus text-[10px]"></i>
                                </button>
                            </form>

                            <div class="flex flex-col items-center px-3">
                                <span class="text-xs font-bold text-gray-800">{{ $item['lama_sewa'] }} Hari</span>
                            </div>

                            <form action="{{ route('pelanggan.keranjang.update', $id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="action" value="plus">
                                <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-md bg-white text-gray-600 hover:bg-gray-200 transition shadow-sm">
                                    <i class="fas fa-plus text-[10px]"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-2xl p-12 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-box-open text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 text-lg mb-2">Keranjang Masih Kosong</h3>
                    <p class="text-gray-500 text-sm mb-6">Yuk, temukan perlengkapan camping dan kamera impianmu sekarang!</p>
                    <a href="{{ route('pelanggan.dashboard') }}" class="px-6 py-2.5 bg-[#0f172a] text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-[#f3a933] hover:text-[#0f172a] transition shadow-lg">Mulai Jelajah</a>
                </div>
                @endforelse
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-[#0f172a] rounded-2xl p-6 md:p-8 shadow-xl sticky top-28 text-white border border-white/5 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#f3a933] rounded-full blur-3xl opacity-20"></div>

                    <h3 class="font-bold text-lg mb-6 flex items-center gap-2 relative z-10">
                        <i class="fas fa-receipt text-[#f3a933]"></i> Ringkasan Pesanan
                    </h3>

                    <div class="space-y-4 text-sm text-gray-300 mb-6 border-b border-white/10 pb-6 relative z-10">
                        <div class="flex justify-between items-center">
                            <span>Total Item</span>
                            <span class="font-medium">{{ count((array) session('keranjang')) }} Alat</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Subtotal Harga</span>
                            <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-end mb-8 relative z-10">
                        <span class="text-xs uppercase tracking-widest font-bold text-gray-400">Total Akhir</span>
                        <span class="text-2xl font-black text-[#f3a933]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    <form action="#" method="POST" class="relative z-10">
                        @csrf
                        <button type="submit" class="w-full py-4 bg-[#f3a933] text-[#0f172a] rounded-xl text-xs font-black uppercase tracking-widest hover:bg-[#d98e1d] transition shadow-[0_10px_20px_rgba(243,169,51,0.3)] flex justify-center items-center gap-2" {{ empty($keranjang) ? 'disabled' : '' }}>
                            Lanjut Pembayaran <i class="fas fa-arrow-right"></i>
                        </button>
                    </form>

                    <p class="text-center text-[9px] text-gray-500 mt-4 uppercase tracking-wider relative z-10">
                        <i class="fas fa-lock mr-1"></i> Transaksi Aman & Terenkripsi
                    </p>
                </div>
            </div>

        </div>
    </main>

    <script>
        const btnMenu = document.getElementById('btnMobileMenu');
        const mobileMenu = document.getElementById('mobileMenu');
        btnMenu.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>

</html>