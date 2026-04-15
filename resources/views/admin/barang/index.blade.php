<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang - Lenscape</title>
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
                <a href="#" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
                    <i class="fas fa-list w-5"></i>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-3 bg-[#f3a933] text-[#0f172a] p-4 rounded-r-full mr-4 font-semibold shadow-lg">
                    <i class="fas fa-box w-5"></i>
                    <span>Barang</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-white/5 p-4 transition text-gray-400">
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
                        <span class="text-red-500 group-hover:text-white text-xs font-bold uppercase tracking-widest">Keluar Sistem</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 p-8 h-screen overflow-y-auto">
            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Daftar Barang</h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola inventaris alat camping dan kamera.</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-sm text-gray-400 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
                        <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
                    </div>
                    <a href="{{ route('admin.barang.create') }}" class="bg-[#0f172a] hover:bg-gray-800 text-white px-5 py-2 rounded-lg shadow-sm font-semibold transition flex items-center gap-2 text-sm">
                        <i class="fas fa-plus text-[#f3a933]"></i> Tambah Barang
                    </a>
                </div>
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
                            <th class="px-6 py-4 font-semibold">Foto</th>
                            <th class="px-6 py-4 font-semibold">Nama Barang</th>
                            <th class="px-6 py-4 font-semibold">Kategori</th>
                            <th class="px-6 py-4 font-semibold">Harga/Hari</th>
                            <th class="px-6 py-4 font-semibold">Stok</th>
                            <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($barang as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    @if($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400 border border-gray-200"><i class="fas fa-image"></i></div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold text-gray-800">{{ $item->nama }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-gray-100 text-gray-600 px-2.5 py-1 rounded border border-gray-200 text-xs font-semibold">{{ $item->kategori->nama ?? 'Tanpa Kategori' }}</span>
                                </td>
                                <td class="px-6 py-4 font-bold text-emerald-600">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 font-bold text-gray-700">{{ $item->stok }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.barang.edit', $item->id) }}" class="bg-[#f3a933]/10 text-[#f3a933] hover:bg-[#f3a933] hover:text-white px-3 py-1.5 rounded-lg font-bold transition text-xs">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus barang ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg font-bold transition text-xs">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <i class="fas fa-box-open text-4xl text-gray-300 mb-3 block"></i>
                                    <p class="text-gray-500 font-medium">Belum ada data barang.</p>
                                </td>
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
</body>
</html>