<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'PostID';

    protected $fillable = [
        'title',
        'content',
        'imgSrc',
        'date',
        'userID',
        'categoryID',
        'likes_count',
        'comments_count',
        'is_solved',
        'status',
    ];

    protected $casts = [
        'date' => 'datetime',
        'is_solved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'UserID');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryID', 'CategoryID');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'postID', 'PostID');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'postID', 'PostID');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('date', 'desc');
    }
}
