<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Mencegah scroll pada body saat sidebar mobile terbuka */
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
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400"> 
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="flex items-center space-x-3 bg-[#f3a933] text-[#0f172a] p-4 lg:rounded-r-full lg:mr-4 font-semibold shadow-lg">
                    <i class="fas fa-list w-5"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
                    <i class="fas fa-box w-5"></i>
                    <span>Barang</span>
                </a>
                <a href="{{ route('admin.penyewaan.index') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
                    <i class="fas fa-file-invoice w-5"></i>
                    <span>Penyewaan</span>
                </a>
            </nav>

            <div class="p-4 border-t border-white/5 bg-[#0f172a]">
                <div class="flex items-center space-x-3 mb-6 px-2">
                    <div class="w-10 h-10 min-w-[40px] bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] uppercase shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
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
                        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Kelola Kategori</h2>
                        <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar semua kategori barang yang tersedia.</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="hidden sm:block text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
                            <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
                        </div>
                        <button onclick="openModal()" class="w-full md:w-auto bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2.5 rounded-xl shadow-sm font-semibold transition flex items-center justify-center gap-2 text-sm">
                            <i class="fas fa-plus text-[#f3a933]"></i> <span class="whitespace-nowrap">Tambah Kategori</span>
                        </button>
                    </div>
                </div>

                <div class="mb-6 relative w-full md:max-w-md">
                    <form action="{{ route('admin.kategori.index') }}" method="GET">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Cari Kategori..." 
                            class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm">
                    </form>
                </div>

                @if(session('success'))
                    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-xl shadow-sm mb-6 flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <p class="font-medium text-xs md:text-sm">{{ session('success') }}</p>
                    </div>
                @endif

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left">
                            <thead class="bg-gray-50 border-b border-gray-100 text-gray-600">
                                <tr>
                                    <th class="px-6 py-4 font-semibold w-20">No</th>
                                    <th class="px-6 py-4 font-semibold">Nama Kategori</th>
                                    <th class="px-6 py-4 font-semibold text-center w-48">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse ($kategori as $item)
                                    <tr class="hover:bg-gray-50/50 transition">
                                        <td class="px-6 py-4 text-gray-500">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-800 whitespace-nowrap">{{ $item->nama_kategori }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.kategori.edit', $item->id) }}" class="p-2 text-[#f3a933] bg-[#f3a933]/10 rounded-lg hover:bg-[#f3a933] hover:text-white transition">
                                                    <i class="fas fa-pen text-xs"></i>
                                                </a>
                                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-500 hover:text-white transition">
                                                        <i class="fas fa-trash text-xs"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <i class="fas fa-folder-open text-4xl text-gray-300 mb-3 block"></i>
                                            <p class="text-gray-500 font-medium italic">Belum ada data kategori.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <footer class="mt-12 pb-8 text-center text-[10px] text-gray-400 uppercase tracking-widest">
                    <p>&copy; {{ date('Y') }} Lenscape - PBL IT Team</p>
                </footer>
            </div>
        </main>
    </div>

    <div id="modalTambah" class="fixed inset-0 z-[60] hidden overflow-y-auto p-4 sm:p-6">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

        <div class="flex items-center justify-center min-h-screen">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md transform transition-all overflow-hidden border border-gray-100">
                
                <div class="bg-[#0f172a] p-4 flex justify-between items-center">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <i class="fas fa-folder-plus text-[#f3a933]"></i> Tambah Kategori
                    </h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-white transition p-1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-1.5">Nama Kategori</label>
                            <input type="text" name="nama_kategori" required placeholder="Contoh: Kamera DSLR..."
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] transition">
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row justify-end gap-2">
                        <button type="button" onclick="closeModal()"
                            class="w-full sm:w-auto px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-xs font-bold transition order-2 sm:order-1">
                            Batal
                        </button>
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-2 bg-[#f3a933] hover:bg-[#d98e1d] text-[#0f172a] rounded-xl text-xs font-bold shadow-md transition order-1 sm:order-2">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    // Logic Sidebar Mobile
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

    // Logic Modal
    function openModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modalTambah').classList.add('hidden');
        if(!document.body.classList.contains('sidebar-open')) {
            document.body.style.overflow = 'auto';
        }
    }

    <?php if($errors->any()): ?>
        window.addEventListener('load', function() {
            openModal();
        });
    <?php endif; ?>
    </script>

</body>
</html>