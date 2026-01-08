<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'image' => $this->generateRandomImage(),
        ];
    }

    private function generateRandomImage(): ?string
    {
        try {
            $imageUrl = 'https://picsum.photos/800/600?random='.Str::random(8);
            $imageContents = file_get_contents($imageUrl);
            $fileName = 'items/'.Str::random(12).'.jpg';
            Storage::disk('public')->put($fileName, $imageContents);

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }
}
