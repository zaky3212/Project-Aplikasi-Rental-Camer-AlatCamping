<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Penyewaan - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8f9fa] font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#0f172a] text-white flex flex-col sticky top-0 h-screen shadow-xl">
            <div class="p-6">
                <h1 class="text-2xl font-bold tracking-tight">
                    <span class="text-white">Lens</span><span class="text-[#f3a933]">cape</span>
                </h1>
            </div>

            <nav class="flex-1 px-0 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400"> 
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.kategori.index') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
                    <i class="fas fa-list w-5"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
                    <i class="fas fa-box w-5"></i>
                    <span>Barang</span>
                </a>
                <a href="{{ route('admin.penyewaan.index') }}" class="flex items-center space-x-3 bg-[#f3a933] text-[#0f172a] p-4 rounded-r-full mr-4 font-semibold shadow-lg">
                    <i class="fas fa-file-invoice w-5"></i>
                    <span>Penyewaan</span>
                </a>
            </nav>

            <div class="p-4 border-t border-white/5 bg-[#0f172a]">
                <div class="flex items-center space-x-3 mb-6 px-2">
                    <div class="w-10 h-10 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] uppercase shadow-md">
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

        <main class="flex-1 p-8 h-screen overflow-y-auto">
           <div class="flex justify-between items-center mb-8">
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Kelola Penyewaan</h2>
        <p class="text-sm text-gray-500 mt-1">Daftar semua alat yang tersedia di lanscape</p>
    </div>
    
    <div class="flex items-center gap-4">
        <div class="text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
        </div>
        
        <button onclick="openModal()" class="bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow-sm font-semibold transition flex items-center gap-2 text-sm">
            <i class="fas fa-plus text-[#f3a933]"></i> Tambah Penyewa
        </button>
    </div>
</div>

            <div class="mb-6 relative max-w-2xl">
                <form action="{{ route('admin.penyewaan.index') }}" method="GET">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari Penyewa (contoh: Nama Penyewa)..." 
                        class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-[#f3a933] text-sm">
                </form>
            </div>

            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded shadow-sm mb-6 flex items-center gap-3">
                    <i class="fas fa-check-circle"></i>
                    <p class="font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="min-w-full text-sm text-left">
                    <thead class="bg-gray-50 border-b border-gray-100 text-gray-600">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nama Penyewa</th>
                            <th class="px-6 py-4 font-semibold">Nama Barang</th>
                            <th class="px-6 py-4 font-semibold">Kategori</th>
                            <th class="px-6 py-4 font-semibold">No HP</th>
                            <th class="px-6 py-4 font-semibold">Tanggal Sewa</th>
                            <th class="px-6 py-4 font-semibold">Lama Sewa</th>
                            <th class="px-6 py-4 font-semibold">Total Harga</th>
                            <th class="px-6 py-4 font-semibold">Aksi</th>
                            <th class="px-6 py-4 font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($penyewaan as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-gray-800">{{ $item->nama_penyewa }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item->barang->nama }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item->barang->kategori->nama_kategori ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item->no_hp }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item->tanggal_sewa }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $item->lama_sewa }} Hari</td>
                                <td class="px-6 py-4 font-bold text-gray-800">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.penyewaan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($item->status == 'disewa')
                                        <form action="{{ route('admin.penyewaan.update', $item->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="kembali">
                                            <button type="submit" class="bg-[#22c55e] text-white px-4 py-1 rounded-full text-[10px] font-bold uppercase shadow-sm">Kembali</button>
                                        </form>
                                    @else
                                        <span class="px-4 py-1 bg-gray-100 text-gray-500 rounded-full text-[10px] font-bold uppercase">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-12 text-center text-gray-500">Belum ada transaksi penyewaan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <footer class="mt-12 text-center text-xs text-gray-400">
                <p>&copy; {{ date('Y') }} Lenscape - Rental Management System</p>
            </footer>
        </main>
    </div>

    <div id="modalTambah" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden border border-gray-200">
                <div class="bg-gray-100/50 p-4 border-b border-gray-100">
                    <h3 class="text-gray-800 font-bold text-sm">CRUD Penyewaan</h3>
                </div>

                <form action="{{ route('admin.penyewaan.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="grid grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 uppercase mb-1">Nama Penyewa</label>
                                <input type="text" name="nama_penyewa" placeholder="Nama Penyewa..." required
                                    class="w-full bg-white border border-gray-300 rounded px-3 py-1.5 text-xs focus:ring-1 focus:ring-[#f3a933] outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 uppercase mb-1">Nama Barang</label>
                                <select name="barang_id" required class="w-full bg-white border border-gray-300 rounded px-3 py-1.5 text-xs focus:ring-1 focus:ring-[#f3a933] outline-none">
                                    <option value="">Pilih Barang</option>
                                    @foreach($barang as $b)
                                        <option value="{{ $b->id }}">{{ $b->nama }} (Rp{{ number_format($b->harga_sewa) }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 uppercase mb-1">Tanggal Sewa</label>
                                <input type="date" name="tanggal_sewa" required
                                    class="w-full bg-white border border-gray-300 rounded px-3 py-1.5 text-xs outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 uppercase mb-1">Total Harga</label>
                                <input type="text" placeholder="Otomatis..." readonly
                                    class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-1.5 text-xs text-gray-500 outline-none cursor-not-allowed">
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 uppercase mb-1">Kategori</label>
                                <input type="text" placeholder="Pilih Barang..." readonly
                                    class="w-full bg-gray-50 border border-gray-300 rounded px-3 py-1.5 text-xs text-gray-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 uppercase mb-1">No Handphone</label>
                                <input type="text" name="no_hp" placeholder="No Hp..." required
                                    class="w-full bg-white border border-gray-300 rounded px-3 py-1.5 text-xs outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-600 uppercase mb-1">Tanggal Kembali</label>
                                <input type="date" name="tanggal_kembali" required
                                    class="w-full bg-white border border-gray-300 rounded px-3 py-1.5 text-xs outline-none">
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex justify-end gap-3">
                        <button type="button" onclick="closeModal()" class="px-6 py-1 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded text-xs font-bold transition">Batal</button>
                        <button type="submit" class="px-6 py-1 bg-[#f3a933] hover:bg-[#d98e1d] text-[#0f172a] rounded text-xs font-bold shadow-md transition">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

   <script>
    function openModal() {
        document.getElementById('modalTambah').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('modalTambah').classList.add('hidden');
        document.body.style.overflow = 'auto';
        // Membersihkan error saat modal ditutup agar tidak membekas
        clearErrors();
    }

    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('input, select').forEach(el => {
            el.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
        });
    }

    // Logic untuk Error Decorators & Auto-Open Modal
    <?php if($errors->any()): ?>
        window.addEventListener('load', function() {
            openModal();

            // Mengambil data error dari Laravel
            const errors = <?php echo json_encode($errors->toArray()); ?>;
            
            Object.keys(errors).forEach(field => {
                // Mencari elemen input berdasarkan atribut name
                const input = document.querySelector(`[name="${field}"]`);
                
                if (input) {
                    // Beri border merah dan ring focus merah
                    input.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                    
                    // Tambahkan pesan error kecil di bawah input
                    const errorDiv = document.createElement('div');
                    errorDiv.className = 'error-message text-[10px] text-red-500 font-bold mt-1';
                    errorDiv.innerText = errors[field][0];
                    
                    input.parentNode.appendChild(errorDiv);
                }
            });
        });
    <?php endif; ?>
</script>
</body>
</html>