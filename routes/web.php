<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Admin\BarangController;

use App\Http\Controllers\Admin\KategoriController;

Route::get('/', function () {
    return view('welcome');
});

// GRUP ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
<<<<<<< HEAD
    Route::resource('barang', BarangController::class);
=======
    Route::resource('kategori', KategoriController::class);
>>>>>>> 266cbe01e7b81e4c063f2fd7f554428c6e34230a
});

// GRUP PELANGGAN
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('dashboard');
});

<<<<<<< HEAD
require __DIR__ . '/auth.php';
=======
require __DIR__.'/auth.php';

>>>>>>> 266cbe01e7b81e4c063f2fd7f554428c6e34230a
