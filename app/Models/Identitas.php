<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Identitas extends Model
{
    use HasFactory;
    protected $table = 'identitas';

    protected $fillable = [
        'user_id',
        'no_kk',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'jenis_kelamin',
        'anak_ke',
        'jumlah_saudara',
        'tinggal_bersama',
        'pendidikan_terakhir',
        'no_hp_1',
        'no_hp_2',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'alamat_lengkap',
        'kode_pos',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'usia' => 'integer',
        'anak_ke' => 'integer',
        'jumlah_saudara' => 'integer',
    ];

    // Relationship ke User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk nama lengkap dari relasi user
    public function getNamaLengkapAttribute()
    {
        return $this->user->name ?? '';
    }

    // Accessor untuk format tanggal lahir Indonesia
    public function getTanggalLahirFormatAttribute()
    {
        return $this->tanggal_lahir ? $this->tanggal_lahir->format('d-m-Y') : '';
    }

    // Accessor untuk tempat, tanggal lahir
    public function getTempatTanggalLahirAttribute()
    {
        return $this->tempat_lahir . ', ' . $this->tanggal_lahir_format;
    }

    // Mutator untuk menghitung usia otomatis saat tanggal_lahir diubah
    public function setTanggalLahirAttribute($value)
    {
        $this->attributes['tanggal_lahir'] = $value;

        if ($value) {
            $lahir = Carbon::parse($value);
            $sekarang = Carbon::now();
            $this->attributes['usia'] = $lahir->diffInYears($sekarang);
        }
    }

    // Scope untuk pencarian berdasarkan wilayah
    public function scopeByWilayah($query, $provinsi = null, $kabupaten = null, $kecamatan = null)
    {
        if ($provinsi) {
            $query->where('provinsi', $provinsi);
        }
        if ($kabupaten) {
            $query->where('kabupaten', $kabupaten);
        }
        if ($kecamatan) {
            $query->where('kecamatan', $kecamatan);
        }
        return $query;
    }

    // Scope untuk pencarian berdasarkan jenis kelamin
    public function scopeByJenisKelamin($query, $jenisKelamin)
    {
        return $query->where('jenis_kelamin', $jenisKelamin);
    }

    // Scope untuk pencarian berdasarkan rentang usia
    public function scopeByRentangUsia($query, $usiaMin = null, $usiaMax = null)
    {
        if ($usiaMin) {
            $query->where('usia', '>=', $usiaMin);
        }
        if ($usiaMax) {
            $query->where('usia', '<=', $usiaMax);
        }
        return $query;
    }
}
