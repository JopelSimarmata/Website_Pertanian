<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\ProductSeeder;
use Database\Seeders\ProductCategorySeeder;
use Database\Seeders\UserSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Ensure the demo admin user exists
        \App\Models\User::firstOrCreate(
            ['email' => 'jennifersihotang04@gmail.com'],
            ['name' => 'Jennifer', 'password' => bcrypt('password')]
        );

        // Seed categories and additional users first, then products
        $this->call([ProductCategorySeeder::class, UserSeeder::class]);

        // Seed products
        $this->call(ProductSeeder::class);
    }
}
