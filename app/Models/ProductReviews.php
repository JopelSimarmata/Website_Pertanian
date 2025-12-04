<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class ProductReviews extends Model
{
    protected $table = 'product_reviews';
    protected $primaryKey = 'review_id';

    protected $fillable = [
        'product_id',
        'buyer_id',
        'rating',
        'comment',
        'helpful_count',
    ];

    // Relasi ke product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // Relasi ke user (buyer)
    public function user()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    // Alias untuk buyer
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }
}
