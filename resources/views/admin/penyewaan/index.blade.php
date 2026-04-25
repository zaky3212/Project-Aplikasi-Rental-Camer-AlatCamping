<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Penyewaan - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Sembunyikan scrollbar tapi tetap bisa scroll */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#f8f9fa] font-sans overflow-x-hidden">

@php
    // Simulasi data user yang login
    if(!Auth::check()) {
        $user = new stdClass();
        $user->name = "Admin Lenscape";
        auth()->loginUsingId(1); // Hanya jika di lingkungan Laravel
    }

    // Simulasi data Barang untuk Dropdown Modal
    $barang = collect([
        (object)['id' => 1, 'nama' => 'Sony A7III', 'harga_sewa' => 250000],
        (object)['id' => 2, 'nama' => 'Canon EOS R6', 'harga_sewa' => 300000],
        (object)['id' => 3, 'nama' => 'Fujifilm X-T4', 'harga_sewa' => 200000],
    ]);

    // Simulasi data Penyewaan untuk Tabel
    $penyewaan = collect([
        (object)[
            'id' => 1,
            'nama_penyewa' => 'Ahmad Zarkasi',
            'barang' => (object)['nama' => 'Sony A7III', 'kategori' => (object)['nama_kategori' => 'Kamera']],
            'no_hp' => '081234567890',
            'lama_sewa' => 2,
            'tanggal_sewa' => '2023-10-25',
            'total_harga' => 500000,
            'status' => 'disewa'
        ],
        (object)[
            'id' => 2,
            'nama_penyewa' => 'Siti Sarah',
            'barang' => (object)['nama' => 'Tripod Beike', 'kategori' => (object)['nama_kategori' => 'Aksesoris']],
            'no_hp' => '085711223344',
            'lama_sewa' => 1,
            'tanggal_sewa' => '2023-10-24',
            'total_harga' => 50000,
            'status' => 'kembali'
        ],
        (object)[
            'id' => 3,
            'nama_penyewa' => 'Budi Doremi',
            'barang' => (object)['nama' => 'Lensa 50mm f1.8', 'kategori' => (object)['nama_kategori' => 'Lensa']],
            'no_hp' => '089988776655',
            'lama_sewa' => 3,
            'tanggal_sewa' => '2023-10-20',
            'total_harga' => 300000,
            'status' => 'kembali'
        ]
    ]);
@endphp

    <div class="flex flex-col md:flex-row min-h-screen">
        
        <header class="md:hidden bg-[#0f172a] text-white p-4 flex justify-between items-center sticky top-0 z-50">
            <h1 class="text-xl font-bold tracking-tight">Lens<span class="text-[#f3a933]">cape</span></h1>
            <button onclick="toggleSidebar()" class="p-2 text-[#f3a933]">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </header>

      <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0f172a] text-white flex flex-col transform -translate-x-full md:translate-x-0 md:sticky md:top-0 h-screen transition-transform duration-300 shadow-xl">
    
   <div class="p-6 flex-shrink-0" style="display: block !important;">
    <h1 class="text-2xl font-bold tracking-tight flex">
        <span class="text-white">Lens</span>
        <span class="text-[#f3a933]">cape</span>
    </h1>
</div>
    <button onclick="toggleSidebar()" class="md:hidden absolute top-5 right-5 text-gray-400">
        <i class="fas fa-times text-xl"></i>
    </button>

    <nav class="flex-1 px-0 space-y-1 mt-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400"> 
                    <i class="fas fa-home w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
                    <i class="fas fa-list w-5 text-center"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
                    <i class="fas fa-box w-5 text-center"></i>
                    <span>Barang</span>
                </a>
                <a href="{{ route('admin.penyewaan.index') }}" class="flex items-center space-x-3 bg-[#f3a933] text-[#0f172a] p-4 md:rounded-r-full md:mr-4 font-semibold shadow-lg">
                    <i class="fas fa-file-invoice w-5 text-center"></i>
                    <span>Penyewaan</span>
                </a>
            </nav>

            <div class="p-4 border-t border-white/5 bg-[#0f172a]">
                <div class="flex items-center space-x-3 mb-6 px-2">
                    <div class="w-10 h-10 bg-[#f3a933] rounded-full flex-shrink-0 flex items-center justify-center font-bold text-[#0f172a] uppercase shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-sm font-semibold truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider">Admin</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full group flex items-center justify-center space-x-2 bg-red-500/10 hover:bg-red-600 p-2.5 rounded-xl transition-all duration-300 border border-red-500/20 shadow-sm">
                        <i class="fas fa-power-off text-red-500 group-hover:text-white transition-colors"></i>
                        <span class="text-red-500 group-hover:text-white text-xs font-bold uppercase tracking-widest">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>

        <main class="flex-1 p-4 md:p-8 h-screen overflow-y-auto no-scrollbar">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-8">
                <div>
                    <h2 class="text-xl md:text-2xl font-bold text-gray-800">Kelola Penyewaan</h2>
                    <p class="text-xs md:text-sm text-gray-500 mt-1">Daftar transaksi penyewaan alat Lenscape</p>
                </div>
                
                <div class="flex flex-wrap items-center gap-3 w-full lg:w-auto">
                    <div class="text-[11px] md:text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100 flex-grow lg:flex-grow-0 text-center">
                        <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
                    </div>
                    
                    <button onclick="openModal()" class="bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow-sm font-semibold transition flex items-center justify-center gap-2 text-sm flex-grow lg:flex-grow-0">
                        <i class="fas fa-plus text-[#f3a933]"></i> <span class="whitespace-nowrap">Tambah Penyewa</span>
                    </button>
                </div>
            </div>

            <div class="mb-6 relative w-full lg:max-w-2xl">
                <form action="{{ route('admin.penyewaan.index') }}" method="GET">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400 text-sm"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari Nama Penyewa..." 
                        class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm transition-all">
                </form>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left">
                        <thead class="bg-gray-50 border-b border-gray-100 text-gray-600 whitespace-nowrap">
                            <tr>
                                <th class="px-6 py-4 font-semibold">Penyewa</th>
                                <th class="px-6 py-4 font-semibold">Alat</th>
                                <th class="px-6 py-4 font-semibold hidden lg:table-cell">Kategori</th>
                                <th class="px-6 py-4 font-semibold">No HP</th>
                                <th class="px-6 py-4 font-semibold">Tanggal</th>
                                <th class="px-6 py-4 font-semibold">Total</th>
                                <th class="px-6 py-4 font-semibold text-center">Status</th>
                                <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse ($penyewaan as $item)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-800 whitespace-nowrap">{{ $item->nama_penyewa }}</td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $item->barang->nama }}</td>
                                    <td class="px-6 py-4 text-gray-600 hidden lg:table-cell">{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">{{ $item->no_hp }}</td>
                                    <td class="px-6 py-4 text-gray-600 whitespace-nowrap">
                                        <div class="text-[10px] text-gray-400 uppercase font-bold">{{ $item->lama_sewa }} Hari</div>
                                        {{ $item->tanggal_sewa }}
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-800 whitespace-nowrap">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        @if($item->status == 'disewa')
                                            <form action="{{ route('admin.penyewaan.update', $item->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="kembali">
                                                <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-wider shadow-sm transition">Kembali</button>
                                            </form>
                                        @else
                                            <span class="px-4 py-1 bg-gray-100 text-gray-400 rounded-full text-[9px] font-black uppercase tracking-wider">Selesai</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                       <div class="flex justify-center items-center space-x-2">
        <button onclick="openEditModal({{ json_encode([
            'id' => $item->id,
            'nama_penyewa' => $item->nama_penyewa,
            'barang_id' => $item->barang_id ?? ($item->barang->id ?? null),
            'no_hp' => $item->no_hp,
            'tanggal_sewa' => $item->tanggal_sewa,
            'tanggal_kembali' => $item->tanggal_kembali ?? ''
        ]) }})" 
        class="text-blue-500 hover:text-blue-700 transition-colors p-2">
            <i class="fas fa-edit text-xs"></i>
        </button>
                                            <form action="{{ route('admin.penyewaan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-2">
                                                    <i class="fas fa-trash-alt text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-400">Belum ada transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <footer class="mt-12 pb-8 text-center text-[10px] text-gray-400 uppercase tracking-widest">
                <p>&copy; {{ date('Y') }} Lenscape Team | PBL Informatics</p>
            </footer>
        </main>
    </div>

    <div id="modalTambah" class="fixed inset-0 z-[100] hidden overflow-y-auto">
        <div class="fixed inset-0 bg-[#0f172a]/60 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen p-4 md:p-6">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">
                <div class="bg-gray-50 p-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-gray-800 font-bold text-sm">Form Transaksi Baru</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600"><i class="fas fa-times"></i></button>
                </div>

                <form action="{{ route('admin.penyewaan.store') }}" method="POST" class="p-6 md:p-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Nama Penyewa</label>
                                <input type="text" name="nama_penyewa" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#f3a933]/20 focus:border-[#f3a933] outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Pilih Alat</label>
                                <select name="barang_id" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-[#f3a933]">
                                    <option value="">Pilih Barang...</option>
                                    @foreach($barang as $b)
                                        <option value="{{ $b->id }}">{{ $b->nama }} (Rp{{ number_format($b->harga_sewa) }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Tanggal Mulai</label>
                                <input type="date" name="tanggal_sewa" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">No Handphone</label>
                                <input type="text" name="no_hp" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" required class="w-full bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-500 uppercase mb-1">Estimasi Total</label>
                                <div class="w-full bg-gray-50 border border-dashed border-gray-300 rounded-lg px-3 py-2 text-xs text-gray-400 font-semibold italic">
                                    Dihitung otomatis oleh sistem
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col md:flex-row justify-end gap-3">
                        <button type="button" onclick="closeModal()" class="w-full md:w-auto px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-xs font-bold transition">Batal</button>
                        <button type="submit" class="w-full md:w-auto px-8 py-2.5 bg-[#f3a933] hover:bg-[#d98e1d] text-[#0f172a] rounded-xl text-xs font-black uppercase tracking-widest shadow-lg transition">Simpan Transaksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        function openModal() {
            document.getElementById('modalTambah').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modalTambah').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
    
    <script>
        function openEditModal(data) {
    
    const modal = document.getElementById('modalEdit');
    const form = document.getElementById('formEdit');

    
    form.action = `/admin/penyewaan/${data.id}`;

    
    document.getElementById('edit_nama_penyewa').value = data.nama_penyewa;
    document.getElementById('edit_barang_id').value = data.barang_id;
    document.getElementById('edit_no_hp').value = data.no_hp;
    document.getElementById('edit_tanggal_sewa').value = data.tanggal_sewa;

    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
    </script>
    
</body>
</html>