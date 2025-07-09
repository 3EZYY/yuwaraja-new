<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email', 
        'password',
        'program_studi',
        'angkatan',
        'nomor_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'role',
        'kelompok_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggal_lahir' => 'date',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user can access Filament admin panel
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Hanya user dengan role 'admin' atau 'spv' yang bisa masuk panel admin
        return in_array($this->role, ['admin', 'spv']);
    }

    // Relasi dengan model lain
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }

    public function penanggungjawab()
    {
        return $this->hasMany(Kelompok::class, 'penanggung_jawab_id');
    }
}
