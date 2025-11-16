<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    // Table name matches migration which created `product` (singular)
    protected $table = 'product';
    protected $primaryKey = 'product_id';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image_url',
    ];

    // Relasi ke category (many products belong to one category)
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Relasi ke order_items (satu product bisa ada di banyak order_items)
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'product_id', 'product_id');
    }

    // Relasi many-to-many ke orders melalui tabel pivot order_items
    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(
            Order::class,
            'order_items',
            'product_id',
            'order_id'
        )->withPivot(['quantity', 'price']);
    }
}
