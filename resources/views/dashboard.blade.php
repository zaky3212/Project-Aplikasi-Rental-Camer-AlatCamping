<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lenscape - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-[#1e293b] text-white flex flex-col">
            <div class="p-6">
                <h1 class="text-2xl font-bold tracking-tight">Lenscape</h1>
            </div>
            
            <nav class="flex-1 px-4 space-y-2">
                <a href="#" class="flex items-center space-x-3 bg-white/10 p-3 rounded-lg">
                    <i class="fas fa-th-large w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-white/5 p-3 rounded-lg transition">
                    <i class="fas fa-list w-5"></i>
                    <span>Kategori</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-white/5 p-3 rounded-lg transition">
                    <i class="fas fa-box w-5"></i>
                    <span>Barang</span>
                </a>
                <a href="#" class="flex items-center space-x-3 hover:bg-white/5 p-3 rounded-lg transition">
                    <i class="fas fa-receipt w-5"></i>
                    <span>Penyewaan</span>
                </a>
            </nav>

            <div class="p-4 border-t border-white/10 flex items-center space-x-3">
                <div class="w-10 h-10 bg-gray-500 rounded-full flex items-center justify-center font-bold">F</div>
                <div>
                    <p class="text-sm font-semibold">Fariel Jadmiko</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </div>
        </aside>

        <main class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Dashboard Overview</h2>
                    <p class="text-sm text-gray-500">Pantau aktivitas penyewaan dan ketersediaan alat hari ini.</p>
                </div>
                <div class="text-sm text-gray-400 bg-white px-3 py-1 rounded shadow-sm">
                    11 April 2026
                </div>
            </div>

            <div class="grid grid-cols-4 gap-6 mb-8">
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
                        <p class="text-2xl font-bold">0 <span class="text-sm font-normal text-gray-400">Kategori</span></p>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-pink-400">
                    <div class="p-3 bg-pink-100 rounded-full text-pink-600"><i class="fas fa-shopping-cart"></i></div>
                    <div>
                        <p class="text-xs text-gray-500">Total Transaksi</p>
                        <p class="text-2xl font-bold">0 <span class="text-sm font-normal text-gray-400">Transaksi</span></p>
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

            <div class="grid grid-cols-3 gap-8">
                <div class="col-span-2 bg-white p-6 rounded-xl shadow-sm">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-800">Aktivitas Transaksi Terbaru</h3>
                        <a href="#" class="text-sm text-orange-500 font-semibold">Lihat Semua →</a>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                            <div class="flex items-center space-x-4">
                                <span class="px-2 py-1 bg-green-100 text-green-600 text-[10px] rounded font-bold uppercase">Selesai</span>
                                <p class="text-sm text-gray-600">Pelanggan Test melakukan transaksi <strong>TRX-0004</strong></p>
                            </div>
                            <span class="text-xs text-gray-400">1 menit ago</span>
                        </div>
                        <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
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

                    <div class="bg-[#1e293b] p-6 rounded-xl shadow-sm text-white">
                        <h3 class="font-bold mb-2">Sistem Status</h3>
                        <p class="text-xs text-gray-400 mb-4">Aplikasi berjalan dengan lancar, pantau terus barang yang keluar masuk.</p>
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
                <p>2026 Lenscape</p>
                <p>Server Time: 2026-04-11 21:05:28</p>
            </footer>
        </main>
    </div>

</body>
</html>