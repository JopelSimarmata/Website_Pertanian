<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductCategories;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // create some categories if not exists
        $categoriesData = [
            ['slug' => 'sayur', 'icon' => 'icon-veg', 'description' => 'Sayuran segar lokal'],
            ['slug' => 'buah', 'icon' => 'icon-fruit', 'description' => 'Buah-buahan segar'],
            ['slug' => 'padi', 'icon' => 'icon-grain', 'description' => 'Produk padi dan biji-bijian'],
        ];

        foreach ($categoriesData as $c) {
            ProductCategories::firstOrCreate(['slug' => $c['slug']], $c);
        }

        $categories = ProductCategories::all();

        // create multiple users
        $users = User::factory(6)->create();

        // create products for each user (3-6 products per user)
        foreach ($users as $user) {
            Product::factory()->count(rand(3, 6))->create([
                'seller_id' => $user->id,
                'category_id' => $categories->random()->category_id,
            ]);
        }

        // keep a specific user (optional)
        User::factory()->create([
            'name' => 'Jennifer',
            'email' => 'jennifersihotang04@gmail.com',
        ]);
    }
}
