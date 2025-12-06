<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ForumTopic;
use App\Models\ForumPost;
use App\Models\User;

class ForumCategories extends Model
{
    protected $table = 'forum_categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
        'description',
    ];

    // 1..n topics (threads) dalam satu kategori
    public function topics()
    {
        return $this->hasMany(ForumTopic::class, 'category_id', 'category_id');
    }

    // semua post yang berada di topic-topic kategori ini (hasManyThrough)
    public function posts()
    {
        return $this->hasManyThrough(
            ForumPost::class,   // final model
            ForumTopic::class,  // through model
            'category_id',      // foreign key on ForumTopic table...
            'topic_id',         // foreign key on ForumPost table...
            'category_id',      // local key on this model
            'topic_id'          // local key on ForumTopic (adjust if PK name different)
        );
    }


    public function moderators()
    {
        return $this->belongsToMany(User::class, 'forum_category_user', 'category_id', 'user_id')->withTimestamps();
    }

    public function threads()
    {
        return $this->hasMany(ForumThread::class, 'category_id', 'category_id');
    }
}
