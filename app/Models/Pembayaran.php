<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'user_id',
        'kode_pembayaran',
        'jenis_pembayaran',
        'jumlah_tagihan',
        'deskripsi',
        'bukti_pembayaran',
        'nominal',
        'tanggal_transfer',
        'batas_pembayaran',
        'bank_pengirim',
        'nama_pengirim',
        'status_verifikasi',
        'status_pembayaran',
        'keterangan',
        'bukti_pembayaran_original',
        'bukti_pembayaran_uploaded_at',
        'verified_by',
        'verified_at',
    ];

    protected $casts = [
        'tanggal_transfer' => 'date',
        'batas_pembayaran' => 'datetime',
        'bukti_pembayaran_uploaded_at' => 'datetime',
        'verified_at' => 'datetime',
        'nominal' => 'decimal:2',
        'jumlah_tagihan' => 'decimal:2',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with admin who verified the payment
    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Accessor for formatted nominal
    public function getFormattedNominalAttribute()
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }

    // Accessor for bukti pembayaran URL - handles both Cloudinary URLs and local storage paths
    public function getBuktiPembayaranUrlAttribute(): ?string
    {
        if (!$this->bukti_pembayaran) {
            return null;
        }

        // If it's already a full URL (Cloudinary), return as-is
        if (filter_var($this->bukti_pembayaran, FILTER_VALIDATE_URL)) {
            return $this->bukti_pembayaran;
        }

        // If it's a local storage path, convert to URL
        return Storage::url($this->bukti_pembayaran);
    }

    // Accessor for file size
    public function getFileSizeAttribute()
    {
        // For Cloudinary URLs, we cannot get file size from storage
        // So we'll rely on the stored file size or return null
        if ($this->bukti_pembayaran) {
            // If it's a Cloudinary URL, we can't get size from Storage::size
            if (filter_var($this->bukti_pembayaran, FILTER_VALIDATE_URL)) {
                return null; // Could be enhanced to fetch from Cloudinary API if needed
            }

            // For local storage, get size as before
            if (Storage::exists($this->bukti_pembayaran)) {
                $bytes = Storage::size($this->bukti_pembayaran);
                return $this->formatBytes($bytes);
            }
        }
        return null;
    }

    // Helper method to format bytes
    private function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }

    // Get verification status label
    public function getStatusVerifikasiLabelAttribute()
    {
        return match ($this->status_verifikasi) {
            'pending' => 'Menunggu Verifikasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Tidak Diketahui'
        };
    }

    // Get status badge class for display
    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status_verifikasi) {
            'pending' => 'badge-warning',
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
            default => 'badge-secondary'
        };
    }

    // Get status text for display
    public function getStatusTextAttribute()
    {
        return match ($this->status_verifikasi) {
            'pending' => 'Menunggu Verifikasi',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            default => 'Status Tidak Diketahui'
        };
    }

    // Backward compatibility accessor for status_pembayaran
    public function getStatusPembayaranAttribute()
    {
        return match ($this->status_verifikasi) {
            'approved' => 'lunas',
            'rejected' => 'gagal',
            'pending' => 'pending',
            default => 'pending'
        };
    }

    // Generate unique payment code
    public static function generateKodePembayaran($jenis = 'pendaftaran')
    {
        $prefix = match ($jenis) {
            'pendaftaran' => 'PDF',
            'spp_bulanan' => 'SPP',
            'seragam' => 'SRG',
            'kitab' => 'KTB',
            'kegiatan' => 'KGT',
            'lainnya' => 'LN',
            default => 'PMB'
        };

        $year = date('Y');
        $month = date('m');

        // Use database transaction to ensure uniqueness
        return DB::transaction(function () use ($prefix, $year, $month, $jenis) {
            $attempts = 0;
            $maxAttempts = 100; // Increased max attempts

            do {
                $attempts++;

                if ($attempts === 1) {
                    // First attempt: sequential number based on existing codes with same prefix
                    $pattern = $prefix . $year . $month . '%';
                    $count = self::where('kode_pembayaran', 'LIKE', $pattern)->lockForUpdate()->count() + 1;
                    $code = $prefix . $year . $month . str_pad($count, 4, '0', STR_PAD_LEFT);
                } elseif ($attempts <= 5) {
                    // Attempts 2-5: try different sequential numbers
                    $pattern = $prefix . $year . $month . '%';
                    $count = self::where('kode_pembayaran', 'LIKE', $pattern)->lockForUpdate()->count() + $attempts;
                    $code = $prefix . $year . $month . str_pad($count, 4, '0', STR_PAD_LEFT);
                } else {
                    // Attempts 6+: use timestamp + random for guaranteed uniqueness
                    $timestamp = microtime(true);
                    $microseconds = intval(($timestamp - floor($timestamp)) * 1000000);
                    $random = mt_rand(10, 99);

                    // Create a unique suffix using timestamp and random
                    $suffix = substr($microseconds, -2) . $random;
                    $code = $prefix . $year . $month . $suffix;

                    // Ensure it's exactly the right length
                    if (strlen($code) > 12) {
                        $code = substr($code, 0, 12);
                    }
                }

                // Double-check if code exists with a FOR UPDATE lock to prevent race conditions
                $exists = self::where('kode_pembayaran', $code)->lockForUpdate()->exists();

                if (!$exists) {
                    return $code;
                }

                // Add a small delay to reduce contention
                if ($attempts > 10) {
                    usleep(mt_rand(1000, 5000)); // 1-5ms delay
                }
            } while ($attempts < $maxAttempts);

            // Ultimate fallback: use uniqid for guaranteed uniqueness
            $uniqueId = strtoupper(substr(uniqid('', true), -4));
            $fallbackCode = $prefix . $year . $month . $uniqueId;

            // Ensure it's not too long
            if (strlen($fallbackCode) > 12) {
                $fallbackCode = substr($fallbackCode, 0, 12);
            }

            return $fallbackCode;
        });
    }

    // Get payment type label
    public function getJenisPembayaranLabelAttribute()
    {
        return match ($this->jenis_pembayaran) {
            'pendaftaran' => 'Biaya Pendaftaran',
            'spp_bulanan' => 'SPP Bulanan',
            'seragam' => 'Biaya Seragam',
            'ujian' => 'Buku & Alat Tulis', // Legacy support
            'kitab' => 'Kitab-kitab Pelajaran',
            'kegiatan' => 'Biaya Kegiatan',
            'lainnya' => 'Biaya Lainnya',
            default => $this->jenis_pembayaran ?? 'Tidak Diketahui'
        };
    }

    // Get status pembayaran label
    public function getStatusPembayaranLabelAttribute()
    {
        return match ($this->status_pembayaran) {
            'belum_bayar' => 'Belum Bayar',
            'pending' => 'Menunggu Verifikasi',
            'lunas' => 'Lunas',
            'gagal' => 'Gagal/Ditolak',
            default => 'Tidak Diketahui'
        };
    }

    // Get status pembayaran badge class
    public function getStatusPembayaranBadgeAttribute()
    {
        return match ($this->status_pembayaran) {
            'belum_bayar' => 'badge-secondary',
            'pending' => 'badge-warning',
            'lunas' => 'badge-success',
            'gagal' => 'badge-danger',
            default => 'badge-secondary'
        };
    }

    // Check if payment is overdue
    public function getIsOverdueAttribute()
    {
        return $this->batas_pembayaran &&
            $this->batas_pembayaran < now() &&
            $this->status_pembayaran !== 'lunas';
    }

    // Get formatted jumlah tagihan
    public function getFormattedJumlahTagihanAttribute()
    {
        return 'Rp ' . number_format($this->jumlah_tagihan, 0, ',', '.');
    }

    /**
     * Get file URL (Cloudinary or local storage)
     */
    public function getFileUrl($field): ?string
    {
        $filePath = $this->getAttribute($field);

        if (!$filePath) {
            return null;
        }

        // Check if it's a Cloudinary URL (starts with https://res.cloudinary.com)
        if (str_starts_with($filePath, 'https://res.cloudinary.com')) {
            return $filePath; // Return Cloudinary URL directly
        }

        // Legacy: Check local storage (for backward compatibility)
        if (Storage::disk('public')->exists($filePath)) {
            return asset('storage/' . $filePath);
        }

        return null;
    }
}
