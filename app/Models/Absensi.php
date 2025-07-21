<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'judul',
        'deskripsi',
        'qr_code',
        'jam_mulai',
        'jam_selesai',
        'is_active',
    ];

    protected $casts = [
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->qr_code)) {
                $model->qr_code = Str::random(32);
            }
        });
    }

    public function absensiMahasiswa()
    {
        return $this->hasMany(AbsensiMahasiswa::class);
    }

    public function mahasiswaHadir()
    {
        return $this->absensiMahasiswa()->with('user');
    }

    /**
     * Check if absensi is currently active
     */
    public function isCurrentlyActive()
    {
        $now = Carbon::now();
        return $this->is_active && 
               $now->between($this->jam_mulai, $this->jam_selesai);
    }

    /**
     * Get total mahasiswa yang sudah absen
     */
    public function getTotalHadirAttribute()
    {
        return $this->absensiMahasiswa()->count();
    }

    /**
     * Get total mahasiswa yang belum absen
     */
    public function getTotalBelumHadirAttribute()
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        return $totalMahasiswa - $this->total_hadir;
    }

    /**
     * Generate QR Code URL
     */
    public function getQrCodeUrlAttribute()
    {
        return route('absensi.scan', $this->qr_code);
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        if (!$this->is_active) {
            return 'Tidak Aktif';
        }

        $now = Carbon::now();
        if ($now->lt($this->jam_mulai)) {
            return 'Belum Dimulai';
        } elseif ($now->gt($this->jam_selesai)) {
            return 'Sudah Berakhir';
        } else {
            return 'Sedang Berlangsung';
        }
    }

    /**
     * Get status color for badge
     */
    public function getStatusColorAttribute()
    {
        if (!$this->is_active) {
            return 'gray';
        }

        $now = Carbon::now();
        if ($now->lt($this->jam_mulai)) {
            return 'yellow';
        } elseif ($now->gt($this->jam_selesai)) {
            return 'red';
        } else {
            return 'green';
        }
    }
}