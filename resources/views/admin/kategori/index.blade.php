<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#f8f9fa] font-sans">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-[#0f172a] text-white flex flex-col sticky top-0 h-screen shadow-xl">
        <div class="p-6">
            <h1 class="text-2xl font-bold tracking-tight">
                <span class="text-white">Lens</span><span class="text-[#f3a933]">cape</span>
            </h1>
        </div>

        <nav class="flex-1 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 text-gray-400">
                <i class="fas fa-home w-5"></i>
                <span>Dashboard</span>
            </a>

            <!-- AKTIF -->
            <a href="{{ route('admin.kategori.index') }}" class="flex items-center space-x-3 bg-[#f3a933] text-[#0f172a] p-4 rounded-r-full mr-4 font-semibold shadow-lg">
                <i class="fas fa-list w-5"></i>
                <span>Kategori</span>
            </a>

            <a href="{{ route('admin.barang.index') }}" class="flex items-center space-x-3 hover:bg-white/5 p-4 text-gray-400">
                <i class="fas fa-box w-5"></i>
                <span>Barang</span>
            </a>

            <a href="#" class="flex items-center space-x-3 hover:bg-white/5 p-4 text-gray-400">
                <i class="fas fa-file-invoice w-5"></i>
                <span>Penyewaan</span>
            </a>
        </nav>

        <!-- USER -->
        <div class="p-4 border-t border-white/5">
            <div class="flex items-center space-x-3 mb-6 px-2">
                <div class="w-10 h-10 bg-[#f3a933] rounded-full flex items-center justify-center font-bold text-[#0f172a] uppercase">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-gray-500 uppercase">Administrator</p>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex justify-center items-center gap-2 bg-red-500/10 hover:bg-red-600 p-2 rounded-xl text-red-500 hover:text-white text-xs font-bold">
                    <i class="fas fa-power-off"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-8 overflow-y-auto">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kelola Kategori</h2>
                <p class="text-sm text-gray-500 mt-1">Daftar semua kategori barang</p>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-400 bg-white px-4 py-2 rounded-lg border">
                    <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
                </div>

                <a href="{{ route('admin.kategori.create') }}"
                   class="bg-[#0f172a] text-white px-5 py-2 rounded-lg font-semibold flex items-center gap-2 text-sm">
                    <i class="fas fa-plus text-[#f3a933]"></i> Tambah Kategori
                </a>
            </div>
        </div>

        <!-- ALERT -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($kategori as $item)
                        <tr>
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>

                            <td class="px-6 py-4 font-semibold">
                                {{ $item->nama_kategori }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">

                                    <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                       class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded text-xs font-bold">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs font-bold">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-10 text-gray-400">
                                Belum ada data kategori
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- FOOTER -->
        <footer class="mt-10 text-center text-xs text-gray-400">
            © {{ date('Y') }} Lenscape
        </footer>

    </main>
</div>

</body>
</html>