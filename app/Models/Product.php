<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'seller_id',
        'price',
        'stock',
        'unit',
        'rating',
        'category_id',
        // 'image_url' removed: not present in DB schema — avoid Unknown column errors
        'location',
        'farmer_email',
        'farmer_phone',
        'detail_address',
    ];

    /**
     * Relasi ke kategori produk (many products belong to one category)
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategories::class, 'category_id', 'category_id');
    }

    /**
     * Relasi ke penjual (user)
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'seller_id', 'id');
    }

    /**
     * Relasi ke review (one product has many reviews)
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ProductReviews::class, 'product_id', 'product_id');
    }

    /**
     * Relasi ke permintaan kunjungan (visit requests)
     */
    public function visitRequests(): HasMany
    {
        return $this->hasMany(VisitRequest::class, 'product_id', 'product_id');
    }

    /**
     * Relasi tidak langsung ke pembayaran melalui VisitRequest
     */
    public function payments(): HasManyThrough
    {
        return $this->hasManyThrough(
            Payments::class,
            VisitRequest::class,
            'product_id',   
            'request_id',   
            'product_id',   
            'request_id' 
        );
    }
}
