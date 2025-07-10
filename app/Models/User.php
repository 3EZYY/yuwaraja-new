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
        'nim',
        'username',
        'program_studi', 
        'angkatan',
        'nomor_telepon',
        'tanggal_lahir',
        'jenis_kelamin',
        'email',
        'password',
        'role', // Untuk admin panel, admin bisa mengubah role
        'kelompok_id', // Untuk admin panel, admin bisa assign kelompok
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
        // Hanya user dengan role 'admin' yang bisa masuk panel admin
        return $this->role === 'admin';
    }

    // Relasi dengan model lain
    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class, 'kelompok_id');
    }

    public function spv()
    {
        return $this->belongsTo(\App\Models\User::class, 'spv_id');
    }

    public function mahasiswa()
    {
        return $this->hasMany(\App\Models\User::class, 'kelompok_id');
    }
}
