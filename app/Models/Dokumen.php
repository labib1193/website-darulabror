<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Dokumen extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dokumen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'foto_ktp',
        'foto_ijazah',
        'surat_sehat',
        'foto_kk',
        'pas_foto',
        'foto_ktp_original',
        'foto_ijazah_original',
        'surat_sehat_original',
        'foto_kk_original',
        'pas_foto_original',
        'foto_ktp_size',
        'foto_ijazah_size',
        'surat_sehat_size',
        'foto_kk_size',
        'pas_foto_size',
        'foto_ktp_uploaded_at',
        'foto_ijazah_uploaded_at',
        'surat_sehat_uploaded_at',
        'foto_kk_uploaded_at',
        'pas_foto_uploaded_at',
        'status_verifikasi',
        'catatan_verifikasi',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'foto_ktp_uploaded_at' => 'datetime',
        'foto_ijazah_uploaded_at' => 'datetime',
        'surat_sehat_uploaded_at' => 'datetime',
        'foto_kk_uploaded_at' => 'datetime',
        'pas_foto_uploaded_at' => 'datetime',
    ];

    /**
     * Get the user that owns the dokumen.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get full URL for foto KTP
     */
    public function getFotoKtpUrlAttribute(): ?string
    {
        return $this->foto_ktp ? Storage::url($this->foto_ktp) : null;
    }

    /**
     * Get full URL for foto ijazah
     */
    public function getFotoIjazahUrlAttribute(): ?string
    {
        return $this->foto_ijazah ? Storage::url($this->foto_ijazah) : null;
    }

    /**
     * Get full URL for surat sehat
     */
    public function getSuratSehatUrlAttribute(): ?string
    {
        return $this->surat_sehat ? Storage::url($this->surat_sehat) : null;
    }

    /**
     * Get full URL for foto KK
     */
    public function getFotoKkUrlAttribute(): ?string
    {
        return $this->foto_kk ? Storage::url($this->foto_kk) : null;
    }

    /**
     * Get full URL for pas foto
     */
    public function getPasFotoUrlAttribute(): ?string
    {
        return $this->pas_foto ? Storage::url($this->pas_foto) : null;
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSize($field): string
    {
        $size = $this->getAttribute($field . '_size');
        if (!$size) return '-';

        $units = ['B', 'KB', 'MB', 'GB'];
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    /**
     * Check if document is complete
     */
    public function isComplete(): bool
    {
        return !empty($this->foto_ktp) &&
            !empty($this->foto_ijazah) &&
            !empty($this->surat_sehat) &&
            !empty($this->foto_kk) &&
            !empty($this->pas_foto);
    }

    /**
     * Get completion percentage
     */
    public function getCompletionPercentage(): int
    {
        $fields = ['foto_ktp', 'foto_ijazah', 'surat_sehat', 'foto_kk', 'pas_foto'];
        $completed = 0;

        foreach ($fields as $field) {
            if (!empty($this->$field)) {
                $completed++;
            }
        }

        return round(($completed / count($fields)) * 100);
    }
}
