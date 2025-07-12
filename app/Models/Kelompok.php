<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompoks';

    protected $fillable = [
        'nama_kelompok',
        'spv_id',
    ];

    // Relasi
    public function spv()
    {
        return $this->belongsTo(User::class, 'spv_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(User::class, 'kelompok_id');
    }

    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }
}
