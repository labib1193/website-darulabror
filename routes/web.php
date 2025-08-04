<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\BeritaController;

// ✅ Authentication fallback route
Route::get('/login', function () {
    return redirect()->route('user.auth.login');
})->name('login');

// ✅ Prefix untuk route admin
Route::prefix('admin')->name('admin.')->group(function () {
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

// Profil sub-pages
Route::get('/profil/sambutan', function () {
    return view('public.profil.sambutan');
})->name('profil.sambutan');

Route::get('/profil/sejarah', function () {
    return view('public.profil.sejarah');
})->name('profil.sejarah');

Route::get('/profil/visi-misi', function () {
    return view('public.profil.visi-misi');
})->name('profil.visi-misi');

Route::get('/profil/ekstrakurikuler', function () {
    return view('public.profil.ekstrakurikuler');
})->name('profil.ekstrakurikuler');

Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

Route::get('/ekstrakurikuler', function () {
    return view('public.ekstrakurikuler');
})->name('ekstrakurikuler');

// Kurikulum sub-pages
Route::get('/kurikulum/tpq', function () {
    return view('public.kurikulum.tpq');
})->name('kurikulum.tpq');

Route::get('/kurikulum/madrasah-diniyah', function () {
    return view('public.kurikulum.madrasah-diniyah');
})->name('kurikulum.madrasah-diniyah');

Route::get('/kurikulum/bq-pi', function () {
    return view('public.kurikulum.bq-pi');
})->name('kurikulum.bq-pi');

Route::get('/kontak', function () {
    return view('public.kontak');
})->name('kontak');

Route::get('galeri', function () {
    return view('public.galeri');
})->name('galeri');

Route::get('/pendaftaran', function () {
    return view('public.pendaftaran');
})->name('pendaftaran');

// ✅ Contact form route
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ✅ Debug routes (only for development)
if (app()->environment('local', 'development')) {
    require __DIR__ . '/debug.php';
}
