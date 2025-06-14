<?php

use Illuminate\Support\Facades\Route;

// ✅ Prefix untuk route admin
Route::prefix('admin')->middleware('web')->group(function () {
    require __DIR__ . '/admin.php';
});

// ✅ Prefix untuk route user
Route::prefix('user')->middleware('web')->group(function () {
    require __DIR__ . '/user.php';
});

// ✅ Route Umum
Route::get('/', function () {
    return view('public.home');
})->name('beranda');

Route::get('/profil', function () {
    return view('public.profil');
})->name('profil');

Route::get('/berita', function () {
    return view('public.berita');
})->name('berita');

Route::get('/ekstrakurikuler', function () {
    return view('public.ekstrakurikuler');
})->name('ekstrakurikuler');

Route::get('/kontak', function () {
    return view('public.kontak');
})->name('kontak');

Route::get('galeri', function () {
    return view('public.galeri');
})->name('galeri');

Route::get('/pendaftaran', function () {
    return view('public.pendaftaran');
})->name('pendaftaran');
