<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Pelanggan\PelangganController;

use App\Http\Controllers\Admin\KategoriController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('kategori', KategoriController::class);
});

Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', [PelangganController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';

