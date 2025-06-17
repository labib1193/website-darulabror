<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'user_id',
        'bukti_pembayaran',
        'nominal',
        'tanggal_transfer',
        'bank_pengirim',
        'nama_pengirim',
        'status_verifikasi',
        'keterangan',
        'bukti_pembayaran_original',
        'bukti_pembayaran_uploaded_at',
    ];

    protected $casts = [
        'tanggal_transfer' => 'date',
        'bukti_pembayaran_uploaded_at' => 'datetime',
        'nominal' => 'decimal:2',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for formatted nominal
    public function getFormattedNominalAttribute()
    {
        return 'Rp ' . number_format($this->nominal, 0, ',', '.');
    }

    // Accessor for file size
    public function getFileSizeAttribute()
    {
        if ($this->bukti_pembayaran && Storage::exists($this->bukti_pembayaran)) {
            $bytes = Storage::size($this->bukti_pembayaran);
            return $this->formatBytes($bytes);
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

    // Accessor for status badge class
    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status_verifikasi) {
            'approved' => 'badge-success',
            'rejected' => 'badge-danger',
            'pending' => 'badge-warning',
            default => 'badge-secondary'
        };
    }

    // Accessor for status text
    public function getStatusTextAttribute()
    {
        return match ($this->status_verifikasi) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'pending' => 'Menunggu Verifikasi',
            default => 'Tidak Diketahui'
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
}
