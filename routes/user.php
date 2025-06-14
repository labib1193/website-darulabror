<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\UserAuthController;
use App\Http\Controllers\User\IdentitasController;
use App\Http\Controllers\User\OrangtuaController;
use App\Http\Controllers\User\DokumenController;
use App\Http\Controllers\User\PembayaranController;
use App\Http\Controllers\User\PengaturanController;
use App\Http\Controllers\User\CetakpdfController;

// Route yang hanya bisa diakses oleh guest (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserAuthController::class, 'showLogin'])->name('user.auth.login');
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::get('/register', [UserAuthController::class, 'showRegister'])->name('user.auth.register');
    Route::post('/register', [UserAuthController::class, 'register']);
});

// Route yang butuh login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('user.identitas');
    })->name('user.dashboard');
    Route::get('/identitas', [IdentitasController::class, 'index'])->name('user.identitas');
    Route::get('/orangtua', [OrangtuaController::class, 'index'])->name('user.orangtua');
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('user.dokumen');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('user.pembayaran');
    Route::post('/cetakpdf', [CetakpdfController::class, 'index'])->name('user.cetakpdf');
    Route::get('/pengaturanakun', [PengaturanController::class, 'index'])->name('user.pengaturanakun');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.auth.logout');
});
