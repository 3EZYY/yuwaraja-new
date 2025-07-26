<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Absensi extends Model
{
    protected $table = 'absensi';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // Accessor untuk format jam
    public function getJamMulaiFormattedAttribute()
    {
        return $this->jam_mulai ? date('H:i', strtotime($this->jam_mulai)) : null;
    }

    public function getJamSelesaiFormattedAttribute()
    {
        return $this->jam_selesai ? date('H:i', strtotime($this->jam_selesai)) : null;
    }

    public function absensiMahasiswa(): HasMany
    {
        return $this->hasMany(AbsensiMahasiswa::class);
    }

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'absensi_mahasiswa', 'absensi_id', 'user_id')
                    ->withPivot(['status', 'waktu_absen', 'keterangan', 'approved_by', 'approved_at'])
                    ->withTimestamps();
    }

    public function mahasiswaHadir()
    {
        return $this->mahasiswa()->wherePivot('status', 'approved');
    }

    public function mahasiswaPending()
    {
        return $this->mahasiswa()->wherePivot('status', 'pending');
    }
}
