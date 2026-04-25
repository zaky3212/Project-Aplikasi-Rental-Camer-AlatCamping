<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sewa Alat - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8f9fa] font-sans">

    <div class="flex min-h-screen relative">
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

    <a href="{{ route('pelanggan.penyewaan') }}" 
       class="flex items-center space-x-3 p-4 transition-all duration-300 lg:rounded-r-full lg:mr-4 font-semibold 
       {{ request()->routeIs('pelanggan.penyewaan') ? 'bg-[#f3a933] text-[#0f172a] shadow-lg' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}"> 
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
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider">Pelanggan</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group flex items-center justify-center space-x-2 bg-red-500/5 hover:bg-red-600 p-2.5 rounded-xl transition-all duration-300 border border-red-500/20">
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
                <div class="mb-8">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800">Penyewaan Alat</h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Pilih kamera atau alat camping terbaik untuk petualanganmu.</p>
                </div>

                <div class="mb-6 relative max-w-md">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" placeholder="Cari alat (contoh: Canon)..." class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-[#f3a933] outline-none text-sm shadow-sm">
                    
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead class="bg-gray-50/50 border-b border-gray-100">
            <tr>
                <th class="px-6 py-4 text-[10px] font-bold uppercase text-gray-400 tracking-widest">Foto</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase text-gray-400 tracking-widest">Nama Barang</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase text-gray-400 tracking-widest">Harga/Hari</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase text-gray-400 tracking-widest">Stok</th>
                <th class="px-6 py-4 text-[10px] font-bold uppercase text-gray-400 tracking-widest text-center">Aksi</th>
            </tr>
        </thead>
      <tbody class="divide-y divide-gray-50">
    @foreach($barangs as $item)
    <tr class="hover:bg-gray-50/50 transition">
        <td class="px-6 py-4">
            <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                @if($item->kategori == 'Kamera')
                    <i class="fas fa-camera text-gray-300"></i>
                @else
                    <i class="fas fa-campground text-gray-300"></i>
                @endif
            </div>
        </td>
        <td class="px-6 py-4">
            <p class="text-sm font-bold text-gray-800">{{ $item->nama_barang }}</p>
            <span class="text-[9px] px-2 py-0.5 {{ $item->kategori == 'Kamera' ? 'bg-blue-50 text-blue-500' : 'bg-orange-50 text-orange-500' }} rounded-full font-bold uppercase">
                {{ $item->kategori }}
            </span>
        </td>
        <td class="px-6 py-4 text-sm font-semibold text-gray-700">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
        <td class="px-6 py-4 text-xs font-bold {{ $item->stok > 0 ? 'text-emerald-500' : 'text-red-500' }}">
            {{ $item->stok }} Unit
        </td>
        <td class="px-6 py-4 text-center">
            @if($item->stok > 0)
                <button onclick="openModal('{{ $item->id }}', '{{ $item->nama_barang }}')" 
                        class="bg-[#f3a933] text-[#0f172a] px-4 py-2 rounded-lg text-xs font-bold hover:bg-[#d9962a] transition-colors">
                    Sewa
                </button>
            @else
                <button disabled class="bg-gray-200 text-gray-400 px-4 py-2 rounded-lg text-xs font-bold cursor-not-allowed">
                    Habis
                </button>
            @endif
        </td>
        <td class="px-6 py-4 text-center">
            @if($item->stok > 0)
                <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-bold uppercase">Tersedia</span>
            @else
                <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-[10px] font-bold uppercase">Dipinjam</span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
</div>
                <footer class="mt-12 pb-8 text-center text-[10px] text-gray-400 uppercase tracking-widest">
                    <p>&copy; {{ date('Y') }} Lenscape - Project Based Learning</p>
                </footer>
            </div>
        </main>
    </div>

    <div id="modalSewa" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-[#0f172a]/60 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="bg-white rounded-2xl p-6 w-full max-w-md relative z-10 shadow-2xl">
            <h3 class="font-bold text-gray-800 mb-4">Konfirmasi Penyewaan</h3>
            <form action="{{ route('pelanggan.penyewaan.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="barang_id" id="modal_barang_id">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alat Dipilih</label>
                    <p id="modal_nama_barang" class="text-sm font-bold text-gray-800"></p>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tgl Sewa</label>
                        <input type="date" name="tgl_sewa" class="w-full border border-gray-200 rounded-lg p-2 text-xs focus:ring-2 focus:ring-[#f3a933] outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tgl Kembali</label>
                        <input type="date" name="tgl_kembali" class="w-full border border-gray-200 rounded-lg p-2 text-xs focus:ring-2 focus:ring-[#f3a933] outline-none">
                    </div>
                </div>
                <div class="flex gap-2 pt-4">
                    <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 bg-gray-100 text-gray-600 rounded-xl text-xs font-bold">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-[#f3a933] text-[#0f172a] rounded-xl text-xs font-black uppercase tracking-widest shadow-lg">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('-translate-x-full');
        }

        function openModal(id, nama) {
            document.getElementById('modalSewa').classList.remove('hidden');
            document.getElementById('modal_barang_id').value = id;
            document.getElementById('modal_nama_barang').innerText = nama;
        }

        function closeModal() {
            document.getElementById('modalSewa').classList.add('hidden');
        }
    </script>
</body>
</html>