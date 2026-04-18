@extends('layouts.admin')

@section('title', 'Dashboard - Admin Lenscape')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Dashboard Overview</h2>
            <p class="text-sm text-gray-500">Pantau aktivitas penyewaan alat hari ini.</p>
        </div>
        <div class="text-sm text-gray-400 bg-white px-3 py-1 rounded shadow-sm border border-gray-100">
            <i class="far fa-calendar-alt mr-2"></i> {{ date('d F Y') }}
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-yellow-400">
            <div class="p-3 bg-yellow-100 rounded-full text-yellow-600"><i class="fas fa-box"></i></div>
            <div>
                <p class="text-xs text-gray-500">Total Alat</p>
                <p class="text-xl md:text-2xl font-bold">10 <span class="text-sm font-normal text-gray-400">Unit</span></p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-blue-400">
            <div class="p-3 bg-blue-100 rounded-full text-blue-600"><i class="fas fa-tags"></i></div>
            <div>
                <p class="text-xs text-gray-500">Total Kategori</p>
                <p class="text-xl md:text-2xl font-bold">5</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-pink-400">
            <div class="p-3 bg-pink-100 rounded-full text-pink-600"><i class="fas fa-shopping-cart"></i></div>
            <div>
                <p class="text-xs text-gray-500">Total Transaksi</p>
                <p class="text-xl md:text-2xl font-bold">12</p>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm flex items-center space-x-4 border-l-4 border-emerald-400">
            <div class="p-3 bg-emerald-100 rounded-full text-emerald-600"><i class="fas fa-wallet"></i></div>
            <div>
                <p class="text-xs text-gray-500">Saldo Terkumpul</p>
                <p class="text-xl md:text-2xl font-bold text-emerald-600 truncate">Rp 100k</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white p-4 md:p-6 rounded-xl shadow-sm overflow-hidden">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-800">Aktivitas Terbaru</h3>
                <a href="#" class="text-xs md:text-sm text-orange-500 font-semibold hover:underline">Lihat Semua →</a>
            </div>
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between py-3 border-b border-gray-50 gap-2">
                    <div class="flex items-center space-x-3">
                        <span class="px-2 py-1 bg-green-100 text-green-600 text-[9px] rounded font-bold uppercase">Selesai</span>
                        <p class="text-xs md:text-sm text-gray-600"><strong>Fariel</strong> menyewa <strong>Kamera</strong></p>
                    </div>
                    <span class="text-[10px] text-gray-400 italic">1 menit yang lalu</span>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white p-6 rounded-xl shadow-sm">
                <h3 class="font-bold text-gray-800 mb-4 text-sm">Aksi Cepat</h3>
                <div class="grid grid-cols-2 lg:grid-cols-1 gap-3">
                    <button class="flex justify-between items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg text-xs font-medium transition">
                        Barang Baru <i class="fas fa-plus text-gray-400"></i>
                    </button>
                    <button class="flex justify-between items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg text-xs font-medium transition">
                        Kategori Baru <i class="fas fa-plus text-gray-400"></i>
                    </button>
                </div>
            </div>

            <div class="bg-[#0f172a] p-6 rounded-xl shadow-sm text-white border border-white/5">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-sm">Sistem Status</h3>
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                </div>
                <p class="text-[10px] text-gray-400">Aplikasi berjalan lancar.</p>
            </div>
        </div>
    </div>
@endsection