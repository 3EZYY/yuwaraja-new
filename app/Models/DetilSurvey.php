<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetilSurvey extends Model
{
    use HasFactory;

    protected $table = 'detil_survey';
    protected $primaryKey = 'id_detil_survey';

    protected $fillable = [
        'id_master_survey',
        'pertanyaan',
        'tipe_pertanyaan',
        'opsi_jawaban',
        'wajib_diisi',
        'urutan'
    ];

    protected $casts = [
        'opsi_jawaban' => 'array',
        'wajib_diisi' => 'boolean',
    ];

    /**
     * Relasi ke master_survey
     */
    public function masterSurvey(): BelongsTo
    {
        return $this->belongsTo(MasterSurvey::class, 'id_master_survey', 'id_master_survey');
    }

    /**
     * Relasi ke hasil_survey
     */
    public function hasilSurvey(): HasMany
    {
        return $this->hasMany(HasilSurvey::class, 'id_detil_survey', 'id_detil_survey');
    }

    /**
     * Scope untuk mengurutkan berdasarkan urutan
     */
    public function scopeUrutan($query)
    {
        return $query->orderBy('urutan');
    }

    /**
     * Scope untuk pertanyaan wajib
     */
    public function scopeWajib($query)
    {
        return $query->where('wajib_diisi', true);
    }

    /**
     * Cek apakah pertanyaan memiliki opsi jawaban
     */
    public function hasOpsiJawaban(): bool
    {
        return in_array($this->tipe_pertanyaan, ['radio', 'checkbox', 'select']) && 
               !empty($this->opsi_jawaban);
    }

    /**
     * Get formatted opsi jawaban
     */
    public function getFormattedOpsiJawabanAttribute(): array
    {
        if (!$this->hasOpsiJawaban()) {
            return [];
        }

        return collect($this->opsi_jawaban)->map(function ($opsi, $key) {
            return [
                'value' => is_array($opsi) ? ($opsi['value'] ?? $key) : $key,
                'label' => is_array($opsi) ? ($opsi['label'] ?? $opsi) : $opsi
            ];
        })->toArray();
    }

    /**
     * Hitung total jawaban untuk pertanyaan ini
     */
    public function getTotalJawabanAttribute(): int
    {
        return $this->hasilSurvey()->count();
    }

    /**
     * Get statistik jawaban untuk pertanyaan pilihan ganda
     */
    public function getStatistikJawaban(): array
    {
        if (!$this->hasOpsiJawaban()) {
            return [];
        }

        $jawaban = $this->hasilSurvey()->get()->pluck('jawaban');
        $total = $jawaban->count();
        
        if ($total === 0) {
            return [];
        }

        $statistik = [];
        foreach ($this->formatted_opsi_jawaban as $opsi) {
            $count = $jawaban->filter(function ($jawab) use ($opsi) {
                // Handle multiple choice (checkbox)
                if ($this->tipe_pertanyaan === 'checkbox') {
                    $jawabanArray = is_string($jawab) ? json_decode($jawab, true) : $jawab;
                    return is_array($jawabanArray) && in_array($opsi['value'], $jawabanArray);
                }
                return $jawab === $opsi['value'];
            })->count();
            
            $statistik[] = [
                'opsi' => $opsi['label'],
                'count' => $count,
                'percentage' => round(($count / $total) * 100, 2)
            ];
        }

        return $statistik;
    }
}