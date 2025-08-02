<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AbsensiMahasiswa extends Model
{
    protected $table = 'absensi_mahasiswa';
    
    protected $fillable = [
        'absensi_id',
        'user_id',
        'status',
        'waktu_absen',
        'keterangan',
        'approved_by',
        'approved_at'
    ];

    protected $casts = [
        'waktu_absen' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function absensi(): BelongsTo
    {
        return $this->belongsTo(Absensi::class);
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
