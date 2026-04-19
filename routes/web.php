<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenyewaanController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Pelanggan\KatalogController;

// 1. PUBLIC ROUTES (Bisa diakses tanpa login)
Route::get('/', function () {
    return view('welcome');
})->name('home');


// 2. ADMIN ROUTES (Hanya Admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('penyewaan', PenyewaanController::class);
});


// 3. PELANGGAN ROUTES (Katalog & Dashboard Pelanggan)
// Pastikan katalog berada di dalam middleware 'role:pelanggan' agar sinkron dengan dashboard


Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    // Rute Dashboard Pelanggan
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('dashboard');

    // Grup Katalog
    Route::prefix('katalog')->name('Katalog.')->group(function () {
        Route::get('/camera', [KatalogController::class, 'katalogCamera'])->name('Katalog_Camera');
        Route::get('/camping', [KatalogController::class, 'katalogCamping'])->name('Katalog_Camping');
    });
});


// 4. GENERAL AUTH ROUTES (Profile)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';