<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
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
        'profile_photo',
        'profile_photo_original',
        'profile_photo_uploaded_at',
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
     * Get profile photo URL with fallback
     */
    public function getProfilePhotoUrlWithFallback()
    {
        if ($this->profile_photo && Storage::disk('public')->exists($this->profile_photo)) {
            return asset('storage/' . $this->profile_photo);
        }
        return asset('AdminLTE/dist/img/user2-160x160.jpg');
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
}
