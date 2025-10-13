<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friendship extends Model
{
    use HasFactory;

    // matches migration: $table->id() created 'id'
    protected $table = 'friendships';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
        'created_at',
        'updated_at',
    ];

    // Eloquent relations using actual column names from migration
    public function requester()
    {
        return $this->belongsTo(User::class, 'user_id', 'UserID');
    }

    public function addressee()
    {
        return $this->belongsTo(User::class, 'friend_id', 'UserID');
    }

    // Convenience accessor so Eloquent code using ->FriendshipID won't break
    public function getFriendshipIDAttribute()
    {
        return $this->getKey();
    }

    // Optional: alias attributes so code expecting requester_id/addressee_id still works via PHP properties
    public function getRequesterIdAttribute()
    {
        return $this->attributes['user_id'] ?? null;
    }

    public function getAddresseeIdAttribute()
    {
        return $this->attributes['friend_id'] ?? null;
    }

    public function setRequesterIdAttribute($value)
    {
        $this->attributes['user_id'] = $value;
    }

    public function setAddresseeIdAttribute($value)
    {
        $this->attributes['friend_id'] = $value;
    }
}