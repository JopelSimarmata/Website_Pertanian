<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForumThread;
use App\Models\User;

class ForumReplies extends Model
{
    
    protected $table = 'forum_replies';
    protected $primaryKey = 'reply_id';

    protected $fillable = [
        'thread_id',
        'author_id',
        'content',
        'is_solution',
    ];

    // Relasi ke thread
    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_id', 'thread_id');
    }

    // Relasi ke user/author
    public function author()
    {
        // ubah User::class dan kunci jika model/PK pengguna Anda berbeda
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
