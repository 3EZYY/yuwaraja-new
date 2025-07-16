<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'friend_id',
        'status'
    ];

    // Relationship ke User (yang mengirim permintaan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship ke User (yang menerima permintaan)
    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    // Scope untuk friendship yang sudah accepted
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    // Scope untuk friendship yang pending
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}