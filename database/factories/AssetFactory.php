<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
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
            'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'purchase_price' => fake()->randomFloat(2, 1000000, 50000000),
            'purchase_date' => fake()->date(),
            'condition' => fake()->randomElement(['Baik', 'Rusak Ringan', 'Rusak Berat']),
            'notes' => fake()->sentence(),
        ];
    }
}
