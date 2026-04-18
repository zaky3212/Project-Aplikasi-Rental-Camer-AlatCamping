<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Controller Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenyewaanController;

use App\Http\Controllers\Pelanggan\PelangganController;

Route::get('/kategori', [KategoriController::class, 'tampilkan'])->name('kategori');


Route::get('/', function () {
    return view('welcome');
});



// ================= GRUP ADMIN =================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('penyewaan', PenyewaanController::class);
});


// ================= GRUP PELANGGAN =================
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('dashboard');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Bawaan Breeze
require __DIR__.'/auth.php';