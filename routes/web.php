<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\AuthController;

// login atau logout 
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.proses');
});

Route::middleware('auth')->group(function() {
    // redirect ke halaman dashboard
    Route::get('/', fn() => redirect()->route('admin.dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // untuk catatan transaksi
    Route::resource('catatan', TransaksiController::class);

    // untuk aktivitas
    Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas');

    // fungsi logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});