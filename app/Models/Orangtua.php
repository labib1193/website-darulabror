<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orangtua extends Model
{
    protected $table = 'orangtua';

    protected $fillable = [
        'user_id',
        'no_kk',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'no_hp_1',
        'pekerjaan',
        'penghasilan',
        'provinsi',
        'kabupaten',
        'kecamatan',
        'alamat_lengkap',
        'kode_pos',
        'status',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
