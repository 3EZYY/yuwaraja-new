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
        'photo',
        'program_studi',
        'angkatan',
        'nomor_telepon',
        'phone',
        'address',
        'tanggal_lahir',
        'jenis_kelamin',
        'email',
        'deskripsi',
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

    // Friendship relationships
    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'user_id');
    }

    public function receivedFriendships()
    {
        return $this->hasMany(Friendship::class, 'friend_id');
    }

    /**
     * Get all friends (accepted friendships)
     * @return \Illuminate\Support\Collection
     */
    public function friends()
    {
        $sentFriends = $this->friendships()->accepted()->with('friend')->get()->pluck('friend');
        $receivedFriends = $this->receivedFriendships()->accepted()->with('user')->get()->pluck('user');
        
        return $sentFriends->merge($receivedFriends);
    }

    /**
     * Check if user is friend with another user
     * @param int $userId
     * @return bool
     */
    public function isFriendWith($userId): bool
    {
        return $this->friendships()->where('friend_id', $userId)->where('status', 'accepted')->exists() ||
               $this->receivedFriendships()->where('user_id', $userId)->where('status', 'accepted')->exists();
    }

    /**
     * Check if friendship request exists
     * @param int $userId
     * @return bool
     */
    public function hasFriendshipRequestWith($userId): bool
    {
        return $this->friendships()->where('friend_id', $userId)->exists() ||
               $this->receivedFriendships()->where('user_id', $userId)->exists();
    }
}
