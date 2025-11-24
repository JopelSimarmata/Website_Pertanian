<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class VisitRequest extends Model
{
    protected $table = 'visit_requests';
    protected $primaryKey = 'request_id';

    protected $fillable = [
        'buyer_id',
        'seller_id',
        'product_id',
        'visit_date',
        'visit_time',
        'quantity',
        'status',
        'notes',
        'rejection_reason',
    ];

    // Relasi: VisitRequest belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
