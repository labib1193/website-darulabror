<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IdentitasController;
use App\Http\Controllers\Admin\OrangtuaController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AuthController;

// Redirect root admin to login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Authentication routes (tidak perlu middleware)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected admin routes (perlu login sebagai admin)
Route::middleware('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserController::class);

    // Data Master - Identitas
    Route::resource('identitas', IdentitasController::class);

    // Data Master - Orangtua
    Route::resource('orangtua', OrangtuaController::class);

    // Data Master - Dokumen
    Route::resource('dokumen', DokumenController::class);

    // Pembayaran
    Route::resource('pembayaran', PembayaranController::class);

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/pendaftar', [LaporanController::class, 'pendaftar'])->name('pendaftar');
        Route::get('/pembayaran', [LaporanController::class, 'pembayaran'])->name('pembayaran');
    });

    // Pengaturan
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});
