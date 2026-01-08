<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'stock' => fake()->numberBetween(0, 1000),
            'unit_id' => \App\Models\Unit::inRandomOrder()->first()?->id ?? 1,
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? 1,
            'description' => fake()->sentence(),
            'image' => null,
        ];
    }
}
