<?php

namespace App\Models;

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

<<<<<<< HEAD
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
=======
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];
>>>>>>> origin/branch-nasad

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
<<<<<<< HEAD
        return $this->hasMany(Friendship::class, 'user_id', 'id');
=======
        // friendships where this user initiated the request
        return $this->hasMany(Friendship::class, 'user_id', 'UserID');
>>>>>>> origin/branch-nasad
    }

    // Friendships where this user is the addressee
    public function friendshipsAsAddressee()
    {
<<<<<<< HEAD
        return $this->hasMany(Friendship::class, 'friend_id', 'id');
=======
        // friendships where this user was added/received the request
        return $this->hasMany(Friendship::class, 'friend_id', 'UserID');
>>>>>>> origin/branch-nasad
    }

    // Alias for sent friend requests
    public function sentFriendRequests()
    {
<<<<<<< HEAD
        return $this->hasMany(Friendship::class, 'user_id', 'id');
=======
        return $this->hasMany(Friendship::class, 'user_id', 'UserID');
>>>>>>> origin/branch-nasad
    }

    // Alias for received friend requests
    public function receivedFriendRequests()
    {
<<<<<<< HEAD
        return $this->hasMany(Friendship::class, 'friend_id', 'id');
=======
        return $this->hasMany(Friendship::class, 'friend_id', 'UserID');
>>>>>>> origin/branch-nasad
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
}