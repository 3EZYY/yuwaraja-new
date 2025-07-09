<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelompok extends Model
{
    use HasFactory;

    protected $table = 'kelompok';

    protected $fillable = [
        'nama_kelompok',
        'penanggung_jawab_id',
    ];

    // Relasi
    public function mahasiswa()
    {
        return $this->hasMany(User::class);
    }

    public function penanggungjawab()
    {
        return $this->belongsTo(User::class, 'penanggung_jawab_id');
    }

    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }
}
