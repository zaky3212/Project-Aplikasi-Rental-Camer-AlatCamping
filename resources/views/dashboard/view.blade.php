<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Lenscape</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-stone-50 text-stone-800 font-sans">
    <div class="min-h-screen flex flex-col md:flex-row">
        <aside class="w-full md:w-64 bg-teal-900 text-white flex flex-col shadow-xl">
            <div class="p-6 flex items-center justify-between md:justify-center border-b border-teal-800">
                <h1 class="text-2xl font-bold tracking-widest">LENS<span class="text-teal-400">CAPE</span></h1>
                <button class="md:hidden text-white focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2 hidden md:block">
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-teal-800 rounded-lg text-white font-medium transition-colors shadow-inner">
                    <i class="fas fa-layer-group w-5"></i> Overview
                </a>
                <a href="{{ route('item.list') }}" class="flex items-center gap-3 px-4 py-3 text-teal-100 hover:bg-teal-800 hover:text-white rounded-lg font-medium transition-colors">
                    <i class="fas fa-camera w-5"></i> List Barang
                </a>
            </nav>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-y-auto">
            <header class="bg-white shadow-sm px-8 py-4 flex items-center justify-between sticky top-0 z-10">
                <div class="flex items-center bg-stone-100 rounded-full px-4 py-2 w-full max-w-md border border-stone-200 focus-within:border-teal-400 focus-within:ring-2 focus-within:ring-teal-100 transition-all hidden sm:flex">
                    <i class="fas fa-search text-stone-400"></i>
                    <input type="text" placeholder="Cari nama penyewa atau alat..." class="bg-transparent border-none outline-none ml-3 w-full text-sm placeholder-stone-400">
                </div>
                <div class="flex justify-end sm:justify-between items-center gap-6 w-full sm:w-auto">
                    <div class="flex items-center gap-2 px-3 py-1 bg-teal-50 text-teal-700 rounded-full text-xs font-semibold border border-teal-100">
                        <i class="fas fa-map-marker-alt"></i> Cabang Batam
                    </div>
                    <div class="relative">
                        <i class="fas fa-bell text-stone-400 text-xl cursor-pointer hover:text-teal-600 transition-colors"></i>
                        <span class="absolute -top-1 -right-1 bg-rose-500 w-3 h-3 rounded-full border-2 border-white"></span>
                    </div>
                    <div class="flex items-center gap-3 cursor-pointer">
                        <img src="https://ui-avatars.com/api/?name=Admin+Lenscape&background=0f766e&color=fff" alt="Profile" class="w-10 h-10 rounded-full shadow-sm border-2 border-teal-100">
                        <div class="hidden md:block">
                            <a href="{{ route('login.login') }}" class="text-sm font-semibold text-stone-700">Administrator</a>
                            <p class="text-xs text-stone-500">Super Admin</p>
                        </div>
                    </div>
                </div>
            </header>

            <div class="p-4 sm:p-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-8 gap-4 sm:gap-0">
                    <div>
                        <h2 class="text-3xl font-bold text-stone-800">Dashboard</h2>
                        <p class="text-stone-500 mt-1">Pantau stok gear dan aktivitas sewa hari ini</p>
                    </div>
                    <button class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-2.5 rounded-lg font-medium shadow-lg shadow-teal-200 transition-all flex items-center gap-2 w-full sm:w-auto justify-center">
                        <i class="fas fa-plus"></i> Transaksi Baru
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between group hover:shadow-md transition-shadow">
                        <div>
                            <p class="text-sm font-medium text-stone-500 mb-1">Total Gear</p>
                            <h3 class="text-3xl font-bold text-stone-800">156</h3>
                            <p class="text-xs text-teal-500 font-medium mt-2 flex items-center gap-1"><i class="fas fa-plus-circle"></i> 5 item baru</p>
                        </div>
                        <div class="w-14 h-14 bg-stone-50 text-stone-600 rounded-xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-boxes"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between group hover:shadow-md transition-shadow">
                        <div>
                            <p class="text-sm font-medium text-stone-500 mb-1">Sedang Disewa</p>
                            <h3 class="text-3xl font-bold text-stone-800">42</h3>
                            <p class="text-xs text-teal-500 font-medium mt-2 flex items-center gap-1"><i class="fas fa-arrow-up"></i> Naik 8%</p>
                        </div>
                        <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-people-carry"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between group hover:shadow-md transition-shadow">
                        <div>
                            <p class="text-sm font-medium text-stone-500 mb-1">Tersedia di Store</p>
                            <h3 class="text-3xl font-bold text-stone-800">108</h3>
                            <p class="text-xs text-stone-400 font-medium mt-2 flex items-center gap-1">Siap disewa</p>
                        </div>
                        <div class="w-14 h-14 bg-teal-50 text-teal-600 rounded-xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between group hover:shadow-md transition-shadow">
                        <div>
                            <p class="text-sm font-medium text-stone-500 mb-1">Perlu Maintenance</p>
                            <h3 class="text-3xl font-bold text-stone-800">6</h3>
                            <p class="text-xs text-rose-500 font-medium mt-2 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> Cuci & Kalibrasi</p>
                        </div>
                        <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
                            <i class="fas fa-spray-can"></i>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="bg-white lg:col-span-2 p-6 rounded-2xl shadow-sm border border-stone-100">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-stone-800">Penyewaan Aktif</h3>
                            <a href="#" class="text-sm font-medium text-teal-600 hover:text-teal-800">Lihat Semua</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse whitespace-nowrap">
                                <thead>
                                    <tr class="border-b border-stone-100">
                                        <th class="py-3 px-4 text-sm font-semibold text-stone-500">ID Sewa</th>
                                        <th class="py-3 px-4 text-sm font-semibold text-stone-500">Pelanggan</th>
                                        <th class="py-3 px-4 text-sm font-semibold text-stone-500">Item Gear</th>
                                        <th class="py-3 px-4 text-sm font-semibold text-stone-500">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-50">
                                    <tr class="hover:bg-stone-50 transition-colors">
                                        <td class="py-4 px-4 text-sm font-medium text-stone-800">#LNS-0881</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">Dimas Aditya</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">Sony A7III + Lensa 24-70mm</td>
                                        <td class="py-4 px-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-teal-100 text-teal-700">Diambil</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-stone-50 transition-colors">
                                        <td class="py-4 px-4 text-sm font-medium text-stone-800">#LNS-0880</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">Rina Melati</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">Tenda Eiger 4P, Kompor Portabel</td>
                                        <td class="py-4 px-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-700">Booking</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-stone-50 transition-colors">
                                        <td class="py-4 px-4 text-sm font-medium text-stone-800">#LNS-0879</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">Fajar Nugraha</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">DJI Ronin SC2</td>
                                        <td class="py-4 px-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-rose-100 text-rose-700">Overdue</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-stone-50 transition-colors">
                                        <td class="py-4 px-4 text-sm font-medium text-stone-800">#LNS-0878</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">Komunitas Alam</td>
                                        <td class="py-4 px-4 text-sm text-stone-600">Paket Camping Group (10 Orang)</td>
                                        <td class="py-4 px-4 text-sm">
                                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-stone-100 text-stone-700">Selesai</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-teal-900 rounded-2xl shadow-sm border border-teal-800 p-6 text-white relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-teal-800 rounded-full opacity-50 blur-xl"></div>
                        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 bg-teal-700 rounded-full opacity-50 blur-xl"></div>

                        <h3 class="text-lg font-bold mb-6 relative z-10">Estimasi Omset</h3>
                        <div class="relative z-10">
                            <p class="text-teal-200 text-sm mb-1">Bulan Ini</p>
                            <h4 class="text-3xl xl:text-4xl font-extrabold mb-4">Rp 8.750.000</h4>

                            <div class="space-y-4 mt-8">
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-teal-200">Divisi Kamera & Video</span>
                                        <span class="font-medium">Rp 5.250.000</span>
                                    </div>
                                    <div class="w-full bg-teal-950 rounded-full h-2">
                                        <div class="bg-sky-400 h-2 rounded-full" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-teal-200">Divisi Alat Camping</span>
                                        <span class="font-medium">Rp 3.500.000</span>
                                    </div>
                                    <div class="w-full bg-teal-950 rounded-full h-2">
                                        <div class="bg-amber-400 h-2 rounded-full" style="width: 40%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>