<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\Auth\UserAuthController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\IdentitasController;
use App\Http\Controllers\OrangtuaController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/identitas', [IdentitasController::class, 'index'])->name('user.identitas');
    Route::post('/identitas', [IdentitasController::class, 'update'])->name('user.identitas.update');
    Route::get('/orangtua', [OrangtuaController::class, 'index'])->name('user.orangtua');
    Route::post('/orangtua', [OrangtuaController::class, 'store'])->name('user.orangtua.store');
    Route::get('/orangtua/{orangtua}/edit', [OrangtuaController::class, 'edit'])->name('user.orangtua.edit');
    Route::put('/orangtua/{orangtua}', [OrangtuaController::class, 'update'])->name('user.orangtua.update');
    Route::delete('/orangtua/{orangtua}', [OrangtuaController::class, 'destroy'])->name('user.orangtua.destroy');
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('user.dokumen');
    Route::post('/dokumen', [DokumenController::class, 'store'])->name('user.dokumen.store');
    Route::delete('/dokumen/{field}', [DokumenController::class, 'delete'])->name('user.dokumen.delete');
    Route::get('/dokumen/download/{field}', [DokumenController::class, 'download'])->name('user.dokumen.download');
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('user.pembayaran');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('user.pembayaran.store');
    Route::get('/pembayaran/download/{id}', [PembayaranController::class, 'download'])->name('user.pembayaran.download');
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'delete'])->name('user.pembayaran.delete');
    Route::get('/cetakpdf', [CetakpdfController::class, 'index'])->name('user.cetakpdf');
    Route::post('/cetakpdf/generate', [CetakpdfController::class, 'generatePdf'])->name('user.cetakpdf.generate');
    Route::get('/cetakpdf/preview', [CetakpdfController::class, 'previewPdf'])->name('user.cetakpdf.preview');
    Route::get('/pengaturanakun', [PengaturanController::class, 'index'])->name('user.pengaturanakun');
    Route::post('/pengaturanakun/profile', [PengaturanController::class, 'updateProfile'])->name('user.pengaturanakun.profile');
    Route::post('/pengaturanakun/password', [PengaturanController::class, 'updatePassword'])->name('user.pengaturanakun.password');
    Route::post('/pengaturanakun/photo', [PengaturanController::class, 'updateProfilePhoto'])->name('user.pengaturanakun.photo');
    Route::delete('/pengaturanakun/account', [PengaturanController::class, 'deleteAccount'])->name('user.pengaturanakun.delete');
    Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.auth.logout');

    // Test routes for development
    Route::get('/test-fixed-sidebar', function () {
        return view('user.test-fixed-sidebar');
    })->name('user.test.fixed-sidebar');
});
