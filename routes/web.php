<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BarangController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->group(function () {
    // Route untuk Dashboard Utama
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route Resource untuk Manajemen Barang (CRUD)
    Route::resource('barang', BarangController::class);
    
    // Route lainnya bisa ditambahkan di sini (Kategori, Penyewaan, dll)
});