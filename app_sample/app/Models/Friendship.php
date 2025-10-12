<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Friendship extends Model
{
    use HasFactory;

    protected $table = 'friendships';   // not strictly needed, but explicit is nice
    protected $primaryKey = 'friend_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'requester_id',
        'addressee_id',
        'status',
        'requested_at',
        'accepted_at'
    ];

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id', 'UserID');
    }

    public function addressee()
    {
        return $this->belongsTo(User::class, 'addressee_id', 'UserID');
    }
}
