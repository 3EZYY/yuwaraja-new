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
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'email',
        'email_student',
        'asal_sekolah_jenis',
        'asal_sekolah_nama',
        'jurusan_sekolah',
        'asal_kota',
        'alamat_domisili',
        'alamat_lengkap',
        'provinsi',
        'kota',
        'kota_kabupaten',
        'jalur_masuk',
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

    /**
     * Get the URL for the user's avatar in Filament
     */
    public function getFilamentAvatarUrl(): ?string
    {
        if (!$this->photo) {
            return null;
        }
        
        // Jika foto sudah berupa URL lengkap, return as is
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        
        // Jika foto disimpan di public/profile-pictures (path relatif)
        if (str_starts_with($this->photo, 'profile-pictures/')) {
            return asset($this->photo);
        }
        
        // Jika hanya nama file, cek di public/profile-pictures
        if (file_exists(public_path('profile-pictures/' . $this->photo))) {
            return asset('profile-pictures/' . $this->photo);
        }
        
        return null;
    }

    public function absensi()
    {
        return $this->belongsToMany(Absensi::class, 'absensi_mahasiswa')
                    ->withPivot(['status', 'waktu_absen', 'keterangan', 'approved_by', 'approved_at'])
                    ->withTimestamps();
    }

    public function absensiDiajukan()
    {
        return $this->absensi()->wherePivot('status', 'pending');
    }

    public function absensiDiapprove()
    {
        return $this->absensi()->wherePivot('status', 'approved');
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

    // Removed problematic self-referencing relationship
    // Users in the same kelompok should be accessed through the Kelompok model

    public function kelompokDibimbing()
    {
        return $this->hasMany(Kelompok::class, 'spv_id');
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
     * Check if friendship request exists (pending only)
     * @param int $userId
     * @return bool
     */
    public function hasFriendshipRequestWith($userId): bool
    {
        return $this->friendships()->where('friend_id', $userId)->where('status', 'pending')->exists() ||
               $this->receivedFriendships()->where('user_id', $userId)->where('status', 'pending')->exists();
    }
}
