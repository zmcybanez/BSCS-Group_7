<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'CommentID';

    protected $fillable = [
        'text',
        'dateCreated',
        'userID',
        'postID',
        'parent_id',
        'likes_count',
        'status',
    ];

    protected $casts = [
        'dateCreated' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'UserID');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postID', 'PostID');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'CommentID');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'CommentID');
    }
}
