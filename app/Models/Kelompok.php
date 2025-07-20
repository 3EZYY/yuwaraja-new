<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompoks';


    protected $fillable = [
        'nama_kelompok',
        'spv_id',
        'code',
        'photo',
    ];

    protected static function booted()
    {
        static::creating(function ($kelompok) {
            if (!$kelompok->code) {
                do {
                    $code = strtoupper(Str::random(5));
                } while (self::where('code', $code)->exists());
                $kelompok->code = $code;
            }
        });
    }

    // Relasi
    public function spv()
    {
        return $this->belongsTo(User::class, 'spv_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'spv_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(User::class, 'kelompok_id');
    }

    public function anggota()
    {
        return $this->hasMany(User::class, 'kelompok_id')->where('role', 'mahasiswa');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'kelompok_id');
    }

    public function members()
    {
        return $this->hasMany(User::class, 'kelompok_id');
    }

    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }
}
