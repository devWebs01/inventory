<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            // === Asset only ===
            [
                'name' => 'Alat Berat',
                'type' => 'asset',
            ],
            [
                'name' => 'Kendaraan Operasional',
                'type' => 'asset',
            ],
            [
                'name' => 'Bangunan & Fasilitas',
                'type' => 'asset',
            ],

            // === Inventory only ===
            [
                'name' => 'Material Bangunan',
                'type' => 'inventory',
            ],
            [
                'name' => 'Consumable',
                'type' => 'inventory',
            ],
            [
                'name' => 'Sparepart',
                'type' => 'inventory',
            ],

            // === Bisa Asset & Inventory ===
            [
                'name' => 'Peralatan',
                'type' => 'both',
            ],
            [
                'name' => 'Material Proyek',
                'type' => 'both',
            ],

            // === Lain-lain ===
            [
                'name' => 'Lainnya',
                'type' => 'other',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
