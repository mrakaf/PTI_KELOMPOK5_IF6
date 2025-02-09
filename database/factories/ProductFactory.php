<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 10, 1000),
            'image' => 'https://via.placeholder.com/300x300',
            'stock' => fake()->numberBetween(0, 100),
            'is_active' => true,
            'category' => fake()->randomElement(['Electronics', 'Clothing', 'Books', 'Home & Garden'])
        ];
    }
} 