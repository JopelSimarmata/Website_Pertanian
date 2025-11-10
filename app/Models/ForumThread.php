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
}
