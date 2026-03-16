<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;

Route::get('/', [DashboardController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
