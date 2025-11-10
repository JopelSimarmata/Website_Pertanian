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
        'user_id',
        'rating',
        'comment',
        'is_approved',
    ];

    // Relasi ke product
    public function product()
    {
        // jika primary key di products adalah `product_id`:
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // Relasi ke user
    public function user()
    {
        // jika primary key di users adalah `user_id`:
        return $this->belongsTo(User::class, 'user_id', 'user_id');

    }
}
