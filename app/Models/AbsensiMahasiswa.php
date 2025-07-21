<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'absensi_mahasiswa';

    protected $fillable = [
        'absensi_id',
        'user_id',
        'waktu_absen',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'waktu_absen' => 'datetime',
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if absensi is on time
     */
    public function isOnTime()
    {
        return $this->waktu_absen->between(
            $this->absensi->jam_mulai,
            $this->absensi->jam_selesai
        );
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return $this->isOnTime() ? 'Tepat Waktu' : 'Terlambat';
    }

    /**
     * Get status color
     */
    public function getStatusColorAttribute()
    {
        return $this->isOnTime() ? 'green' : 'red';
    }
}