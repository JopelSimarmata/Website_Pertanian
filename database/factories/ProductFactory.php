<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Product::class;

    /**
     * Define the model's default state.
     */
    public function definition()
    {
        $name = $this->faker->words(3, true);
        $price = $this->faker->numberBetween(3000, 15000);

        return [
            'category_id' => 1,
            'seller_id' => 1,
            'name' => ucfirst($name),
            'description' => $this->faker->paragraph(),
            'price' => $price,
            'stock' => $this->faker->numberBetween(100, 10000),
            'unit' => 'kg',
            'rating' => $this->faker->randomFloat(2, 3.5, 5.0),
            'reviews_count' => $this->faker->numberBetween(0, 500),
            'is_active' => true,
            'location' => $this->faker->city . ', ' . $this->faker->state,
            'detail_address' => $this->faker->address,
            'farmer_email' => $this->faker->safeEmail,
            'farmer_phone' => $this->faker->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
