<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductCategories extends Model
{
    protected $table = 'product_categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
        'description',
      
    ];

    // relasi: satu kategori memiliki banyak produk
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }

    // relasi opsional jika ada struktur hirarki kategori (parent/child)
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'category_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'category_id');
    }
}
