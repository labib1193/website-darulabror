# SOLUSI VERIFIKASI EMAIL OTOMATIS

## 1. Tambahkan Route Email Verification

### File: routes/web.php
Tambahkan setelah route yang ada:

```php
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/user/dashboard')->with('success', 'Email berhasil diverifikasi!');
    })->middleware(['signed'])->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi telah dikirim ulang!');
    })->middleware(['throttle:6,1'])->name('verification.send');
});
```

## 2. Buat View Email Verification

### File: resources/views/auth/verify-email.blade.php
```php
@extends('layouts.user')

@section('title', 'Verifikasi Email')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-envelope-open-text"></i> Verifikasi Email
                </h3>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="fas fa-envelope fa-3x text-primary"></i>
                </div>
                
                <h5>Verifikasi Alamat Email Anda</h5>
                <p class="text-muted">
                    Terima kasih telah mendaftar! Sebelum memulai, bisakah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami emailkan kepada Anda?
                </p>
                
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <div class="mt-4">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim Ulang Email Verifikasi
                        </button>
                    </form>
                </div>

                <div class="mt-3">
                    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
```

## 3. Update Halaman Pengaturan Akun

### File: resources/views/user/pengaturanakun.blade.php
Ganti bagian Email Verified dengan:

```php
<tr>
    <td><strong>Email Verified:</strong></td>
    <td>
        @if($user->email_verified_at)
        <span class="badge badge-success">
            <i class="fas fa-check-circle"></i> Terverifikasi
        </span>
        <br>
        <small class="text-muted">{{ $user->email_verified_at->format('d/m/Y H:i') }}</small>
        @else
        <span class="badge badge-warning">
            <i class="fas fa-clock"></i> Belum Terverifikasi
        </span>
        <br>
        <a href="{{ route('verification.notice') }}" class="btn btn-sm btn-primary mt-2">
            <i class="fas fa-envelope"></i> Verifikasi Email
        </a>
        @endif
    </td>
</tr>
```

## 4. Update Controller Registration

### File: app/Http/Controllers/User/Auth/UserAuthController.php
Pastikan method register mengirim email verifikasi:

```php
public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'user',
        'status' => 'active',
    ]);

    // Kirim email verifikasi
    $user->sendEmailVerificationNotification();

    Auth::login($user);

    return redirect()->route('verification.notice')
        ->with('message', 'Akun berhasil dibuat! Silakan verifikasi email Anda.');
}
```

## 5. Konfigurasi Email

### File: .env
Pastikan konfigurasi email sudah benar:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@darulabror.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 6. Middleware Verified (Opsional)

Jika ingin memaksa user verifikasi email sebelum akses fitur tertentu:

### File: routes/user.php
```php
// Route yang butuh email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/identitas', [IdentitasController::class, 'index'])->name('user.identitas');
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('user.dokumen');
    // dst...
});
```

## CARA IMPLEMENTASI:

1. **Tambahkan route email verification ke routes/web.php**
2. **Buat view verify-email.blade.php**
3. **Update halaman pengaturan akun dengan tombol verifikasi**
4. **Update controller registration untuk auto-send email**
5. **Konfigurasi email di .env**
6. **Test kirim email verifikasi**

Setelah implementasi ini, alur kerjanya akan menjadi:
1. User daftar → Email verifikasi otomatis terkirim
2. User cek email → Klik link verifikasi
3. Email terverifikasi → Status berubah otomatis
4. User bisa kirim ulang email jika perlu
