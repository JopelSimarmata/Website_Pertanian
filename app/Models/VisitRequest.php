<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VisitRequest extends Model
{
    protected $table = 'visit_requests';
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'user_id',
        'visit_date',
        'status',
    ];

    // Relasi: VisitRequest belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
