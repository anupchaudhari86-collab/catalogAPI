<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => ucfirst(fake()->unique()->words(2, true)),
            'price' => fake()->randomFloat(2, 10, 999),
            'description' => fake()->optional()->sentence(12),
        ];
    }
}
