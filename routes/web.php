<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PenyewaanController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Barang;

// Controller Pelanggan
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Pelanggan\KatalogController;
use App\Http\Controllers\Pelanggan\KeranjangController;
use App\Http\Controllers\Pelanggan\PenyewaanPelangganController;
use App\Http\Controllers\Pelanggan\CheckoutController; // TAMBAHAN CHECKOUT
use App\Http\Controllers\Pelanggan\RiwayatController;

// Dashboard Controller Utama 
use App\Http\Controllers\DashboardController;

<<<<<<< HEAD
Route::get('/', function () {
    // Ambil 4 barang untuk Kamera (Asumsi pakai relasi kategori atau nama barang)
    $kameras = Barang::whereHas('kategori', function ($query) {
        $query->where('nama_kategori', 'like', '%Camera%')
            ->orWhere('nama_kategori', 'like', '%Kamera%');
    })->take(4)->get();

    // Ambil 4 barang untuk Camping
    $campings = Barang::whereHas('kategori', function ($query) {
        $query->where('nama_kategori', 'like', '%Camping%')
            ->orWhere('nama_kategori', 'like', '%Tenda%');
    })->take(4)->get();

    return view('welcome', compact('kameras', 'campings'));
});
=======
Route::get('/', [DashboardController::class, 'index'])->name('home');
>>>>>>> cc1c1051e29d127d2d4a092828dd46210fb8fe13

// ================= ROUTE ADMIN =================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('barang', BarangController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('penyewaan', PenyewaanController::class);
    Route::resource('user', UserController::class);

    Route::put('/penyewaan/{id}/status', [PenyewaanController::class, 'updateStatus'])->name('penyewaan.updateStatus');
});

// ================= ROUTE PELANGGAN =================
Route::middleware(['auth', 'role:pelanggan'])->prefix('pelanggan')->name('pelanggan.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [PelangganController::class, 'profile'])->name('profile');

    Route::get('/penyewaan', [PenyewaanPelangganController::class, 'index'])->name('penyewaan');
    Route::post('/penyewaan/proses', [PenyewaanPelangganController::class, 'store'])->name('penyewaan.store');

    // Route Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::put('/keranjang/{id}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    // TAMBAHAN: Route Checkout Midtrans
    Route::post('/checkout', [CheckoutController::class, 'prosesCheckout'])->name('checkout.proses');

    // Group Katalog Perlengkapan
    Route::prefix('katalog')->name('Katalog.')->group(function () {
        Route::get('/katalog-camera', [KatalogController::class, 'katalogCamera'])->name('Katalog_Camera');
        Route::get('/camping', [KatalogController::class, 'katalogCamping'])->name('Katalog_Camping');

        Route::get('/katalog-camera/semua', [KatalogController::class, 'lihatSemuaCamera'])->name('Katalog_Camera.semua');
        Route::get('/camping/semua', [KatalogController::class, 'lihatSemuaCamping'])->name('Katalog_Camping.semua');

        Route::get('/barang/{id}', [KatalogController::class, 'detailBarang'])->name('detail_barang');
    });
    
    Route::prefix('riwayat')->name('riwayat.')->group(function () {
        Route::get('/', [RiwayatController::class, 'index'])->name('index');
        Route::get('/{id}', [RiwayatController::class, 'show'])->name('detail');
    });
});

// ================= ROUTE PROFILE (DEFAULT) =================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// ================= ROUTE MIDTRANS CALLBACK (Tanpa Auth) =================
Route::post('/midtrans/callback', [CheckoutController::class, 'callback']);
