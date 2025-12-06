<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;

    protected $table = 'forum_threads';
    protected $primaryKey = 'thread_id';

    protected $fillable = [
        'author_id',
        'title',
        'content',
        'tags',
        'image',
        'views_count',
        'replies_count',
        'is_pinned',
        'is_solved',
    ];

    protected $casts = [
        'tags' => 'array',
        'is_pinned' => 'boolean',
        'is_solved' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(ForumCategories::class, 'category_id', 'category_id');
    }

    public function replies()
    {
        return $this->hasMany(ForumReplies::class, 'thread_id', 'thread_id');
    }
}
