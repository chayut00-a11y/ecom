<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'image' => fake()->imageUrl(360, 360, 'animals', true, 'cats'),
            'category_id' => fake()->numberBetween($min = 1, $max = 3),
            'description' => fake()->paragraph($nb = 2),
            'price' => fake()->numberBetween($min = 500, $max = 1000)
        ];
    }
}
