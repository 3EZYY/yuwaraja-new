<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HasilSurvey extends Model
{
    use HasFactory;

    protected $table = 'hasil_survey';
    protected $primaryKey = 'id_hasil_survey';

    protected $fillable = [
        'id_master_survey',
        'id_detil_survey',
        'user_id',
        'jawaban'
    ];

    /**
     * Relasi ke master_survey
     */
    public function masterSurvey(): BelongsTo
    {
        return $this->belongsTo(MasterSurvey::class, 'id_master_survey', 'id_master_survey');
    }

    /**
     * Relasi ke detil_survey
     */
    public function detilSurvey(): BelongsTo
    {
        return $this->belongsTo(DetilSurvey::class, 'id_detil_survey', 'id_detil_survey');
    }

    /**
     * Relasi ke user (responden)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Scope untuk filter berdasarkan survey
     */
    public function scopeBySurvey($query, $surveyId)
    {
        return $query->where('id_master_survey', $surveyId);
    }

    /**
     * Scope untuk filter berdasarkan user
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk filter berdasarkan pertanyaan
     */
    public function scopeByPertanyaan($query, $pertanyaanId)
    {
        return $query->where('id_detil_survey', $pertanyaanId);
    }

    /**
     * Get formatted jawaban berdasarkan tipe pertanyaan
     */
    public function getFormattedJawabanAttribute(): mixed
    {
        $tipe = $this->detilSurvey->tipe_pertanyaan ?? 'text';
        
        switch ($tipe) {
            case 'checkbox':
                // Untuk checkbox, jawaban disimpan sebagai JSON array
                return is_string($this->jawaban) ? json_decode($this->jawaban, true) : $this->jawaban;
            
            case 'radio':
            case 'select':
                // Untuk radio dan select, cari label dari opsi jawaban
                $opsiJawaban = $this->detilSurvey->opsi_jawaban ?? [];
                foreach ($opsiJawaban as $opsi) {
                    if (is_array($opsi)) {
                        if (($opsi['value'] ?? '') === $this->jawaban) {
                            return $opsi['label'] ?? $this->jawaban;
                        }
                    } else {
                        if ($opsi === $this->jawaban) {
                            return $opsi;
                        }
                    }
                }
                return $this->jawaban;
            
            default:
                return $this->jawaban;
        }
    }

    /**
     * Cek apakah jawaban valid berdasarkan tipe pertanyaan
     */
    public function isValidJawaban(): bool
    {
        $detil = $this->detilSurvey;
        
        if (!$detil) {
            return false;
        }

        // Cek jika pertanyaan wajib diisi
        if ($detil->wajib_diisi && empty($this->jawaban)) {
            return false;
        }

        // Validasi berdasarkan tipe pertanyaan
        switch ($detil->tipe_pertanyaan) {
            case 'radio':
            case 'select':
                if ($detil->hasOpsiJawaban()) {
                    $validOptions = collect($detil->opsi_jawaban)->map(function ($opsi) {
                        return is_array($opsi) ? ($opsi['value'] ?? $opsi) : $opsi;
                    })->toArray();
                    return in_array($this->jawaban, $validOptions);
                }
                break;
            
            case 'checkbox':
                if ($detil->hasOpsiJawaban()) {
                    $jawaban = is_string($this->jawaban) ? json_decode($this->jawaban, true) : $this->jawaban;
                    if (!is_array($jawaban)) {
                        return false;
                    }
                    $validOptions = collect($detil->opsi_jawaban)->map(function ($opsi) {
                        return is_array($opsi) ? ($opsi['value'] ?? $opsi) : $opsi;
                    })->toArray();
                    return collect($jawaban)->every(function ($item) use ($validOptions) {
                        return in_array($item, $validOptions);
                    });
                }
                break;
        }

        return true;
    }

    /**
     * Static method untuk menyimpan jawaban survey
     */
    public static function simpanJawaban(int $surveyId, int $userId, array $jawaban): bool
    {
        try {
            foreach ($jawaban as $pertanyaanId => $jawabanValue) {
                // Hapus jawaban lama jika ada
                static::where('id_master_survey', $surveyId)
                      ->where('id_detil_survey', $pertanyaanId)
                      ->where('user_id', $userId)
                      ->delete();

                // Simpan jawaban baru
                if (!empty($jawabanValue)) {
                    $jawabanToSave = is_array($jawabanValue) ? json_encode($jawabanValue) : $jawabanValue;
                    
                    static::create([
                        'id_master_survey' => $surveyId,
                        'id_detil_survey' => $pertanyaanId,
                        'user_id' => $userId,
                        'jawaban' => $jawabanToSave
                    ]);
                }
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}