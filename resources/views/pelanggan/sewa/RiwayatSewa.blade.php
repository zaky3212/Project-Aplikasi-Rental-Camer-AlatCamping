<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Sewa - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 pt-24 overflow-x-hidden">

    <nav class="fixed top-0 w-full z-50 bg-[#0f172a]/90 backdrop-blur-lg border-b border-white/10 py-3 md:py-4 px-4 md:px-12 flex justify-between items-center transition-all">
        <a href="{{ route('pelanggan.dashboard') }}" class="text-xl md:text-2xl font-bold tracking-tight text-white z-10">
            Lens<span class="text-[#f3a933]">cape</span>
        </a>

        <div class="hidden lg:flex absolute left-1/2 -translate-x-1/2 items-center gap-8 text-sm font-semibold text-gray-300">
            <a href="{{ route('pelanggan.dashboard') }}" class="hover:text-[#f3a933] transition">Beranda</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camera') }}" class="hover:text-[#f3a933] transition">Katalog Camera</a>
            <a href="{{ route('pelanggan.Katalog.Katalog_Camping') }}" class="hover:text-[#f3a933] transition">Katalog Camping</a>
            <a href="{{ route('pelanggan.riwayat.index') }}" class="text-[#f3a933] transition">Riwayat Sewa</a>
            <a href="{{ route('pelanggan.profile') }}" class="hover:text-[#f3a933] transition">Profil</a>
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
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-12">
        <div class="mb-8">
            <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900">Riwayat Sewa</h1>
            <p class="text-gray-500 mt-2 text-sm md:text-base">Daftar transaksi penyewaan yang pernah Anda lakukan.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Kode Transaksi</th>
                            <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Periode Sewa</th>
                            <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Harga</th>
                            <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Denda</th>
                            <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                            <th class="py-4 px-6 text-[10px] font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($penyewaans as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-5 px-6 font-bold text-gray-800 text-sm">{{ $item->kode_transaksi }}</td>
                            <td class="py-5 px-6 text-gray-600 text-sm">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}
                                <span class="text-gray-400 font-bold mx-1">/</span>
                                {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d M Y') }}
                            </td>
                            <td class="py-5 px-6 font-black text-gray-900 text-sm">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td class="py-5 px-6 text-sm">
                                @if($item->denda > 0)
                                <span class="font-bold text-red-600">Rp {{ number_format($item->denda, 0, ',', '.') }}</span>
                                @else
                                <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="py-5 px-6">
                                <span class="px-3 py-1 {{ $statusColors[$item->status] ?? 'bg-gray-100' }} text-[9px] font-black uppercase rounded-full">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="py-5 px-6">
                                <a href="{{ route('pelanggan.riwayat.detail', $item->id) }}" class="text-xs font-bold text-[#0f172a] hover:text-[#f3a933] transition">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-10 text-center text-gray-400 text-sm">Belum ada riwayat sewa.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const profileMenuButton = document.getElementById('profileMenuButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileMenuButton.addEventListener('click', (e) => {
            e.stopPropagation();
            profileDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profileMenuButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>
</body>

</html>