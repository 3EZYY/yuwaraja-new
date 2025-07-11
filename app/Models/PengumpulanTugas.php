<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'kelompok_id',
        'file_path',
        'keterangan',
        'status',
        'nilai',
        'feedback',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'nilai' => 'integer',
    ];

    // Relasi
    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
