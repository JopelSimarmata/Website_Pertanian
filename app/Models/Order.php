<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'request_id',
        'invoice_number',
        'gross_amount',
        'status',
    ];

    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->invoice_number)) {
                $order->invoice_number = 'INV-'.now()->format('YmdHis').'-'.Str::upper(Str::random(4));
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'invoice_number';
    }

    /**
     * Alias accessor to provide `gross_amount` if not present
     */
    public function getGrossAmountAttribute($value)
    {
        // if column exists return it, otherwise fall back to total_price
        if (! empty($value)) {
            return $value;
        }

        return $this->attributes['total_price'] ?? 0;
    }
}