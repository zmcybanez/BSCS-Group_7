<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'id'; // ✅ Simplify if you use default "id"
    public $timestamps = true;    // ✅ Use Laravel's default timestamps

    protected $fillable = [
        'body',         // ✅ Matches controller and form
        'user_id',
        'post_id',
        'parent_id',
        'likes_count',
        'status',
    ];

    // ✅ Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
