<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'pesan',
        'status',
        'read_at'
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function markAsRead()
    {
        $this->update([
            'status' => 'read',
            'read_at' => now()
        ]);
    }

    public function isRead()
    {
        return $this->status === 'read';
    }
}
