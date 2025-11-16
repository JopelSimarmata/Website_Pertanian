<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        DB::table('product_categories')->insert([
            ['slug' => 'sayuran', 'icon' => null, 'description' => 'Sayuran segar', 'created_at' => $now, 'updated_at' => $now],
            ['slug' => 'buah-buahan', 'icon' => null, 'description' => 'Buah segar', 'created_at' => $now, 'updated_at' => $now],
            ['slug' => 'biji-bijian', 'icon' => null, 'description' => 'Jagung, gandum, dsb.', 'created_at' => $now, 'updated_at' => $now],
            ['slug' => 'umbi', 'icon' => null, 'description' => 'Kentang, ubi, dsb.', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
