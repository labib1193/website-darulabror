<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IdentitasController;
use App\Http\Controllers\Admin\OrangtuaController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\PembayaranController;
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');    // User Management
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
    Route::post('users/{user}/verify-email', [UserController::class, 'verifyEmail'])->name('users.verifyEmail');
    Route::post('users/{user}/unverify-email', [UserController::class, 'unverifyEmail'])->name('users.unverifyEmail');
    Route::post('users/bulk-verify-emails', [UserController::class, 'bulkVerifyEmails'])->name('users.bulkVerifyEmails'); // Data Master - Identitas
    Route::resource('identitas', IdentitasController::class)->parameters([
        'identitas' => 'identitas'
    ]);
    Route::patch('identitas/{identitas}/status', [IdentitasController::class, 'updateStatus'])->name('identitas.updateStatus');

    // Data Master - Orangtua
    Route::resource('orangtua', OrangtuaController::class)->parameters([
        'orangtua' => 'orangtua'
    ]);    // Data Master - Dokumen
    Route::resource('dokumen', DokumenController::class)->parameters([
        'dokumen' => 'dokumen'
    ]);
    Route::get('dokumen/{dokumen}/download/{field}', [DokumenController::class, 'download'])->name('dokumen.download');    // Pembayaran
    Route::resource('pembayaran', PembayaranController::class);
    Route::post('pembayaran/{pembayaran}/approve', [PembayaranController::class, 'approve'])->name('pembayaran.approve');
    Route::post('pembayaran/{pembayaran}/reject', [PembayaranController::class, 'reject'])->name('pembayaran.reject');
    Route::get('pembayaran/{pembayaran}/download', [PembayaranController::class, 'download'])->name('pembayaran.download');
    Route::post('pembayaran/bulk-action', [PembayaranController::class, 'bulkAction'])->name('pembayaran.bulkAction');
    Route::patch('pembayaran/{pembayaran}/status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');

    // Pengaturan
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});
