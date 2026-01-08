<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'purchase_date' => fake()->date(),
            'condition' => fake()->randomElement(['Baik', 'Rusak Ringan', 'Rusak Berat']),
            'notes' => fake()->sentence(),
            'image' => $this->generateRandomImage(),
        ];
    }

    private function generateRandomImage(): ?string
    {
        try {
            $imageUrl = 'https://picsum.photos/800/600?random='.Str::random(8);
            $imageContents = file_get_contents($imageUrl);
            $fileName = 'assets/'.Str::random(12).'.jpg';
            Storage::disk('public')->put($fileName, $imageContents);

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }
}
