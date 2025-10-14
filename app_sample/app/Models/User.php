<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * By default, Laravel assumes 'id' as the primary key,
     * auto-increment, and type int — so we don’t even need to override.
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'auth_provider',
        'has_password',
        'role',
        'profile_picture',
        'location',
        'farm_type',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // -----------------------------
    // Relationships
    // -----------------------------

    // Posts authored by this user
    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    // Comments authored by this user
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    // Friendships where this user is the requester
    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'user_id', 'id');
    }

    // Friendships where this user is the addressee
    public function friendshipsAsAddressee()
    {
        return $this->hasMany(Friendship::class, 'friend_id', 'id');
    }

    // Alias for sent friend requests
    public function sentFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'user_id', 'id');
    }

    // Alias for received friend requests
    public function receivedFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'friend_id', 'id');
    }

    // Messages sent by this user
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }

    // Messages received by this user
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'id');
    }

    /**
     * Send the password reset notification with a custom call-to-action label.
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
