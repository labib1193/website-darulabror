<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\IdentitasController;
use App\Http\Controllers\User\OrangtuaController;
use App\Http\Controllers\User\DokumenController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\User\PengaturanController;
use App\Http\Controllers\User\CetakpdfController;

// Login dan Register
Route::get('/login', [AuthController::class, 'showLogin'])->name('user.auth.login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('user.auth.register');
Route::post('/register', [AuthController::class, 'register']);

// Route yang butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/identitas', [IdentitasController::class, 'index'])->name('user.identitas');
    Route::get('/orangtua', [OrangtuaController::class, 'index'])->name('user.orangtua');
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('user.dokumen');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('user.pembayaran');
    Route::post('/cetakpdf', [CetakpdfController::class, 'index'])->name('user.cetakpdf');
    Route::get('/pengaturanakun', [PengaturanController::class, 'index'])->name('user.pengaturanakun');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('user.auth.logout');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('user.auth.login');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('user.auth.register');
    Route::post('/login', [AuthController::class, 'login'])->name('user.auth.login.submit');
    Route::post('/register', [AuthController::class, 'register'])->name('user.auth.register.submit');
});
