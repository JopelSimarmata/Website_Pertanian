<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','product_id'];

    protected $table = 'favorites';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        // Product model uses table 'product' and primary key product_id
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
