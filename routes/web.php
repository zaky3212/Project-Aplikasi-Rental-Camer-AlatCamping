<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenyewaanController;


Route::get('/kategori', [KategoriController::class, 'tampilkan'])->name('kategori');


Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('penyewaan', PenyewaanController::class);
});

// GRUP PELANGGAN
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('dashboard');
});

// File auth disisain satu aja di bawah
require __DIR__.'/auth.php';