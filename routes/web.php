<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenyewaanController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Pelanggan\KatalogController;
use App\Http\Controllers\Pelanggan\KeranjangController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Pelanggan\PenyewaanPelangganController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('penyewaan', PenyewaanController::class);
    Route::resource('user', UserController::class);
});

Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('dashboard');
    Route::get('/profile', [PelangganController::class, 'profile'])->name('profile');

    Route::get('/penyewaan', [PenyewaanPelangganController::class, 'index'])->name('penyewaan');
    Route::post('/penyewaan/proses', [PenyewaanPelangganController::class, 'store'])->name('penyewaan.store');
    
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    Route::prefix('katalog')->name('Katalog.')->group(function () {
        Route::get('/camera', [KatalogController::class, 'katalogCamera'])->name('Katalog_Camera');
        Route::get('/camping', [KatalogController::class, 'katalogCamping'])->name('Katalog_Camping');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';