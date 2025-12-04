<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(mt_rand(2,4), true);

        return [
            'category_id' => 1,
            'seller_id' => null,
            'name' => ucfirst($name),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(5000, 200000),
            'stock' => fake()->numberBetween(1, 200),
            'unit' => fake()->randomElement(['kg','pack','pcs','box','sack']),
            'rating' => fake()->randomFloat(2, 0, 5),
            'reviews_count' => fake()->numberBetween(0, 150),
            'is_active' => true,
            'location' => fake()->city(),
            'detail_address' => fake()->address(),
            'farmer_email' => fake()->safeEmail(),
            'farmer_phone' => fake()->e164PhoneNumber(),
            'image_url' => fake()->imageUrl(640, 480, 'food'),
        ];
    }
}
