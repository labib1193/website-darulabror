<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'verification_status',
        'profile_photo',
        'profile_photo_original',
        'profile_photo_uploaded_at',
        'password_changed_at',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'profile_photo_uploaded_at' => 'datetime',
            'password_changed_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke tabel identitas
     */
    public function identitas()
    {
        return $this->hasOne(Identitas::class);
    }

    /**
     * Relasi ke tabel orangtua
     */
    public function orangtua()
    {
        return $this->hasMany(Orangtua::class);
    }

    /**
     * Relasi ke tabel dokumen
     */
    public function dokumen()
    {
        return $this->hasOne(Dokumen::class);
    }

    /**
     * Relasi ke tabel pembayaran
     */
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    /**
     * Get latest pembayaran
     */
    public function latestPembayaran()
    {
        return $this->hasOne(Pembayaran::class)->latestOfMany();
    }

    /**
     * Get profile photo URL
     */
    public function getProfilePhotoUrl()
    {
        if ($this->profile_photo && Storage::disk('public')->exists($this->profile_photo)) {
            return asset('storage/' . $this->profile_photo);
        }
        return null; // Return null so we can use fallback in views
    }

    /**
     * Get profile photo URL attribute (accessor)
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo && Storage::disk('public')->exists($this->profile_photo)) {
            return asset('storage/' . $this->profile_photo);
        }
        return asset('AdminLTE/dist/img/user2-160x160.jpg'); // Default fallback image
    }

    /**
     * Get formatted file size for profile photo
     */
    public function getProfilePhotoSize()
    {
        if ($this->profile_photo && Storage::disk('public')->exists($this->profile_photo)) {
            $bytes = Storage::disk('public')->size($this->profile_photo);
            return $this->formatBytes($bytes);
        }
        return null;
    }

    /**
     * Helper method to format bytes
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    /**
     * Check if user email is verified
     */
    public function isEmailVerified()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Get email verification status text
     */
    public function getEmailVerificationStatus()
    {
        return $this->isEmailVerified() ? 'Terverifikasi' : 'Belum Verifikasi';
    }

    /**
     * Get email verification badge class
     */
    public function getEmailVerificationBadgeClass()
    {
        return $this->isEmailVerified() ? 'badge-success' : 'badge-warning';
    }

    /**
     * Get verification status text (for email verification)
     */
    public function getVerificationStatusText()
    {
        return match ($this->verification_status ?? 'pending') {
            'pending' => 'Belum Verifikasi',
            'verified' => 'Terverifikasi',
            'rejected' => 'Ditolak',
            default => 'Belum Verifikasi'
        };
    }

    /**
     * Get verification status badge class (for email verification)
     */
    public function getVerificationStatusBadgeClass()
    {
        return match ($this->verification_status ?? 'pending') {
            'pending' => 'badge-warning',
            'verified' => 'badge-success',
            'rejected' => 'badge-danger',
            default => 'badge-warning'
        };
    }
}
