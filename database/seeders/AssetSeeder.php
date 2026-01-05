<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get asset categories only
        $assetCategories = Category::where('type', 'asset')
            ->orWhere('type', 'both')
            ->pluck('id')
            ->toArray();

        $assets = [
            [
                'name' => 'Excavator CAT 320D',
                'category_id' => $this->getCategoryId('Alat Berat', $assetCategories),
                'purchase_date' => '2023-01-15',
                'condition' => 'Baik',
                'notes' => 'Digunakan untuk proyek penggalian',
            ],
            [
                'name' => 'Bulldozer Komatsu D65',
                'category_id' => $this->getCategoryId('Alat Berat', $assetCategories),
                'purchase_date' => '2023-03-20',
                'condition' => 'Baik',
                'notes' => 'Unit pengupas tanah',
            ],
            [
                'name' => 'Toyota Hilux Double Cabin',
                'category_id' => $this->getCategoryId('Kendaraan Operasional', $assetCategories),
                'purchase_date' => '2023-06-10',
                'condition' => 'Baik',
                'notes' => 'Kendaraan operasional lapangan',
            ],
            [
                'name' => 'Mitsubishi Triton',
                'category_id' => $this->getCategoryId('Kendaraan Operasional', $assetCategories),
                'purchase_date' => '2023-07-05',
                'condition' => 'Rusak Ringan',
                'notes' => 'Perlu service rutin',
            ],
            [
                'name' => 'Gedung Kantor Pusat',
                'category_id' => $this->getCategoryId('Bangunan & Fasilitas', $assetCategories),
                'purchase_date' => '2022-01-01',
                'condition' => 'Baik',
                'notes' => 'Bangunan 3 lantai',
            ],
            [
                'name' => 'Gudang Utama',
                'category_id' => $this->getCategoryId('Bangunan & Fasilitas', $assetCategories),
                'purchase_date' => '2022-03-15',
                'condition' => 'Baik',
                'notes' => 'Luas 1000 m2',
            ],
            [
                'name' => 'Generator Set 500 KVA',
                'category_id' => $this->getCategoryId('Peralatan', $assetCategories),
                'purchase_date' => '2023-04-20',
                'condition' => 'Baik',
                'notes' => 'Gensi utama kantor',
            ],
            [
                'name' => 'AC Split 2 PK',
                'category_id' => $this->getCategoryId('Peralatan', $assetCategories),
                'purchase_date' => '2023-05-10',
                'condition' => 'Rusak Ringan',
                'notes' => 'Perlu cuci freon',
            ],
        ];

        foreach ($assets as $asset) {
            Asset::firstOrCreate(
                ['name' => $asset['name']],
                $asset
            );
        }
    }

    private function getCategoryId(string $name, array $categoryIds): ?int
    {
        $category = Category::where('name', $name)->first();

        return $category?->id ?? ($categoryIds[array_rand($categoryIds)] ?? null);
    }
}
