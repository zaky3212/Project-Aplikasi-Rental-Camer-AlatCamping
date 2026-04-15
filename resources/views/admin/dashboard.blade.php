<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lenscape - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#f8f9fa] font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#0f172a] text-white flex flex-col sticky top-0 h-screen">
            <div class="p-6">
                <h1 class="text-2xl font-bold tracking-tight">
                    <span class="text-white">Lens</span><span class="text-[#f3a933]">cape</span>
                </h1>
            </div>

            <nav class="flex-1 px-0 space-y-1">
                <a href="#" class="flex items-center space-x-3 bg-[#f3a933] text-[#0f172a] p-4 rounded-r-full mr-4 font-semibold shadow-lg"> <i class="fas fa-home w-5"></i>
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

        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Dashboard Overview</h2>
                    <p class="text-sm text-gray-500">Pantau aktivitas penyewaan dan ketersediaan alat hari ini.</p>
                </div>
                <div class="text-sm text-gray-400 bg-white px-3 py-1 rounded shadow-sm">
                    {{ date('d F Y') }}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-yellow-400">
                    <div class="p-3 bg-yellow-100 rounded-full text-yellow-600"><i class="fas fa-box"></i></div>
                    <div>
                        <p class="text-xs text-gray-500">Total Alat</p>
                        <p class="text-2xl font-bold">10 <span class="text-sm font-normal text-gray-400">Unit</span></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-blue-400">
                    <div class="p-3 bg-blue-100 rounded-full text-blue-600"><i class="fas fa-tags"></i></div>
                    <div>
                        <p class="text-xs text-gray-500">Total Kategori</p>
                        <p class="text-2xl font-bold">0</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-pink-400">
                    <div class="p-3 bg-pink-100 rounded-full text-pink-600"><i class="fas fa-shopping-cart"></i></div>
                    <div>
                        <p class="text-xs text-gray-500">Total Transaksi</p>
                        <p class="text-2xl font-bold">0</p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-emerald-400">
                    <div class="p-3 bg-emerald-100 rounded-full text-emerald-600"><i class="fas fa-wallet"></i></div>
                    <div>
                        <p class="text-xs text-gray-500">Saldo Terkumpul</p>
                        <p class="text-2xl font-bold text-emerald-600">Rp 100.000</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-800">Aktivitas Transaksi Terbaru</h3>
                        <a href="#" class="text-sm text-orange-500 font-semibold hover:underline">Lihat Semua →</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                            <div class="flex items-center space-x-4">
                                <span class="px-2 py-1 bg-green-100 text-green-600 text-[10px] rounded font-bold uppercase">Selesai</span>
                                <p class="text-sm text-gray-600">Pelanggan Test melakukan transaksi <strong>TRX-0004</strong></p>
                            </div>
                            <span class="text-xs text-gray-400">1 menit ago</span>
                        </div>
                        <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                            <div class="flex items-center space-x-4">
                                <span class="px-2 py-1 bg-green-100 text-green-600 text-[10px] rounded font-bold uppercase">Selesai</span>
                                <p class="text-sm text-gray-600">Pelanggan Test melakukan transaksi <strong>TRX-0003</strong></p>
                            </div>
                            <span class="text-xs text-gray-400">5 menit ago</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm">
                        <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <button class="w-full flex justify-between items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg text-sm font-medium transition">
                                Tambah Barang Baru <i class="fas fa-plus text-gray-400"></i>
                            </button>
                            <button class="w-full flex justify-between items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg text-sm font-medium transition">
                                Tambah Kategori Baru <i class="fas fa-plus text-gray-400"></i>
                            </button>
                        </div>
                    </div>

                    <div class="bg-[#0f172a] p-6 rounded-xl shadow-sm text-white border border-white/5">
                        <h3 class="font-bold mb-2">Sistem Status</h3>
                        <p class="text-xs text-gray-400 mb-4">Aplikasi berjalan dengan lancar.</p>
                        <div class="flex items-center space-x-2 text-emerald-400 text-sm">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                            <span>Sistem Online</span>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="mt-12 flex justify-between text-xs text-gray-400">
                <p>&copy; 2026 Lenscape - Rental Management System</p>
                <p>Server Time: {{ now()->toDateTimeString() }}</p>
            </footer>
        </main>
    </div>

</body>

</html>