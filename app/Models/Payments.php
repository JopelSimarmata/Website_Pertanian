<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    protected $fillable = [
        'buyer_id',
        'request_id',
        'amount',
        'payment_method',
        'status',
        'sender_name',
        'sender_account',
        'payment_proof_url',
        'payment_notes',
    ];

    /**
     * Relasi ke pembeli (user)
     */
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id', 'user_id');
    }

    /**
     * Relasi ke permintaan kunjungan (visit request)
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(VisitRequest::class, 'request_id', 'request_id');
    }
}
