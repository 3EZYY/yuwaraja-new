<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasterSurvey extends Model
{
    use HasFactory;

    protected $table = 'master_survey';
    protected $primaryKey = 'id_master_survey';

    protected $fillable = [
        'judul_survey',
        'deskripsi_survey',
        'status',
        'tanggal_mulai',
        'tanggal_selesai',
        'created_by'
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    /**
     * Relasi ke tabel detil_survey
     */
    public function detilSurvey(): HasMany
    {
        return $this->hasMany(DetilSurvey::class, 'id_master_survey', 'id_master_survey');
    }

    /**
     * Relasi ke tabel hasil_survey
     */
    public function hasilSurvey(): HasMany
    {
        return $this->hasMany(HasilSurvey::class, 'id_master_survey', 'id_master_survey');
    }

    /**
     * Relasi ke user yang membuat survey
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Scope untuk survey aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope untuk survey yang sedang berjalan
     */
    public function scopeBerjalan($query)
    {
        return $query->where('status', 'aktif')
                    ->where('tanggal_mulai', '<=', now())
                    ->where('tanggal_selesai', '>=', now());
    }

    /**
     * Cek apakah survey sedang aktif dan berjalan
     */
    public function isBerjalan(): bool
    {
        return $this->status === 'aktif' && 
               $this->tanggal_mulai <= now() && 
               $this->tanggal_selesai >= now();
    }

    /**
     * Hitung total responden
     */
    public function getTotalRespondenAttribute(): int
    {
        return $this->hasilSurvey()->distinct('user_id')->count('user_id');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'id_master_survey';
    }
}