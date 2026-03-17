<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ItemController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.view');
Route::get('/login', [LoginController::class, 'index'])->name('login.login');
Route::get('/item', [ItemController::class, 'index'])->name('item.list');
