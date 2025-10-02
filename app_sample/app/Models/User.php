<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'UserID'; // ✅ match your migration

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'auth_provider',
        'has_password',
        'role', // ✅ since you added role in migration
        'profile_picture',
        'location',
        'farm_type',
        'bio',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class, 'userID', 'UserID');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'userID', 'UserID');
    }

    // Friendship relationships - proper Eloquent approach
    public function friendships()
    {
        return $this->hasMany(Friendship::class, 'requester_id', 'UserID');
    }

    public function friendshipsAsAddressee()
    {
        return $this->hasMany(Friendship::class, 'addressee_id', 'UserID');
    }

    public function sentFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'requester_id', 'UserID');
    }

    public function receivedFriendRequests()
    {
        return $this->hasMany(Friendship::class, 'addressee_id', 'UserID');
    }

    // Message relationships
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id', 'UserID');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id', 'UserID');
    }
}
