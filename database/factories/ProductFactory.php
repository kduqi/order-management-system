<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->text(),
            'slug' => fake()->slug,
            'price' => fake()->randomFloat(2, 1, 100),
            'quantity' => fake()->numberBetween(1, 100),
        ];
    }
}
