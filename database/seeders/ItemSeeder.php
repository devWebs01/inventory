<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            // Material Bangunan
            ['name' => 'Semen Portland 50kg', 'category' => 'Material Bangunan', 'unit' => 'zak', 'stock' => 150, 'description' => 'Semen Portland kualitas standar SNI'],
            ['name' => 'Semen Gresik 50kg', 'category' => 'Material Bangunan', 'unit' => 'zak', 'stock' => 200, 'description' => 'Semen Gresik kualitas premium'],
            ['name' => 'Bata Merah', 'category' => 'Material Bangunan', 'unit' => 'pcs', 'stock' => 5000, 'description' => 'Bata merah press'],
            ['name' => 'Bata Ringan Hebel', 'category' => 'Material Bangunan', 'unit' => 'pcs', 'stock' => 1200, 'description' => 'Bata ringan ukuran 10x20x60 cm'],
            ['name' => 'Pasir Beton', 'category' => 'Material Bangunan', 'unit' => 'm3', 'stock' => 15, 'description' => 'Pasir beton untuk cor'],
            ['name' => 'Pasir Pasang', 'category' => 'Material Bangunan', 'unit' => 'm3', 'stock' => 10, 'description' => 'Pasir pasang untuk plester'],
            ['name' => 'Batu Split', 'category' => 'Material Bangunan', 'unit' => 'm3', 'stock' => 12, 'description' => 'Batu split 1-2'],
            ['name' => 'Batu Kali', 'category' => 'Material Bangunan', 'unit' => 'm3', 'stock' => 8, 'description' => 'Batu kali untuk pondasi'],
            ['name' => 'Besi Beton 10mm', 'category' => 'Material Bangunan', 'unit' => 'batang', 'stock' => 250, 'description' => 'Besi beton diameter 10mm panjang 12m'],
            ['name' => 'Besi Beton 12mm', 'category' => 'Material Bangunan', 'unit' => 'batang', 'stock' => 200, 'description' => 'Besi beton diameter 12mm panjang 12m'],
            ['name' => 'Besi Beton 16mm', 'category' => 'Material Bangunan', 'unit' => 'batang', 'stock' => 150, 'description' => 'Besi beton diameter 16mm panjang 12m'],
            ['name' => 'Kayu Meranti 4x6', 'category' => 'Material Bangunan', 'unit' => 'batang', 'stock' => 100, 'description' => 'Kayu meranti ukuran 4x6 panjang 4m'],
            ['name' => 'Kayu Meranti 5x7', 'category' => 'Material Bangunan', 'unit' => 'batang', 'stock' => 80, 'description' => 'Kayu meranti ukuran 5x7 panjang 4m'],
            ['name' => 'Papan Triplek 8mm', 'category' => 'Material Bangunan', 'unit' => 'lembar', 'stock' => 50, 'description' => 'Triplek ukuran 1.22 x 2.44 m tebal 8mm'],
            ['name' => 'Papan Triplek 12mm', 'category' => 'Material Bangunan', 'unit' => 'lembar', 'stock' => 40, 'description' => 'Triplek ukuran 1.22 x 2.44 m tebal 12mm'],

            // Consumable
            ['name' => 'Paku 7cm', 'category' => 'Consumable', 'unit' => 'kg', 'stock' => 25, 'description' => 'Paku ukuran 7cm'],
            ['name' => 'Paku 10cm', 'category' => 'Consumable', 'unit' => 'kg', 'stock' => 20, 'description' => 'Paku ukuran 10cm'],
            ['name' => 'Semen 1kg', 'category' => 'Consumable', 'unit' => 'zak', 'stock' => 100, 'description' => 'Semen kemasan kecil 1kg'],
            ['name' => 'Cat Tembok 5kg', 'category' => 'Consumable', 'unit' => 'kaleng', 'stock' => 45, 'description' => 'Cat tembok kemasan 5kg'],
            ['name' => 'Cat Tembok 25kg', 'category' => 'Consumable', 'unit' => 'kaleng', 'stock' => 15, 'description' => 'Cat tembok kemasan 25kg'],
            ['name' => 'Cat Kayi Besi 1kg', 'category' => 'Consumable', 'unit' => 'kaleng', 'stock' => 60, 'description' => 'Cat kayu besi kemasan 1kg'],
            ['name' => 'Thinner', 'category' => 'Consumable', 'unit' => 'liter', 'stock' => 30, 'description' => 'Thinner untuk pengencer cat'],
            ['name' => 'Plamur', 'category' => 'Consumable', 'unit' => 'kg', 'stock' => 40, 'description' => 'Plamur untuk penutup pori dinding'],
            ['name' => 'Amplas', 'category' => 'Consumable', 'unit' => 'lembar', 'stock' => 200, 'description' => 'Amplas No. 10'],
            ['name' => 'Kuas Cat 4inch', 'category' => 'Consumable', 'unit' => 'pcs', 'stock' => 75, 'description' => 'Kuas cat ukuran 4 inch'],
            ['name' => 'Roll Cat', 'category' => 'Consumable', 'unit' => 'pcs', 'stock' => 35, 'description' => 'Roll cat dengan handle'],
            ['name' => 'Kabel Listrik 1.5mm', 'category' => 'Consumable', 'unit' => 'roll', 'stock' => 25, 'description' => 'Kabel listrik Eterna 1.5mm'],
            ['name' => 'Kabel Listrik 2.5mm', 'category' => 'Consumable', 'unit' => 'roll', 'stock' => 20, 'description' => 'Kabel listrik Eterna 2.5mm'],
            ['name' => 'Stop Kontak', 'category' => 'Consumable', 'unit' => 'pcs', 'stock' => 100, 'description' => 'Stop kontak jenis doble'],
            ['name' => 'Saklar', 'category' => 'Consumable', 'unit' => 'pcs', 'stock' => 120, 'description' => 'Saklar tunggal'],

            // Sparepart
            ['name' => 'Oli Mesin 1L', 'category' => 'Sparepart', 'unit' => 'liter', 'stock' => 25, 'description' => 'Oli mesin untuk alat berat'],
            ['name' => 'Oli Gardan 1L', 'category' => 'Sparepart', 'unit' => 'liter', 'stock' => 18, 'description' => 'Oli gardan untuk kendaraan'],
            ['name' => 'Filter Udara', 'category' => 'Sparepart', 'unit' => 'pcs', 'stock' => 30, 'description' => 'Filter udara universal'],
            ['name' => 'Filter Oli', 'category' => 'Sparepart', 'unit' => 'pcs', 'stock' => 40, 'description' => 'Filter oli universal'],
            ['name' => 'Kampas Rem', 'category' => 'Sparepart', 'unit' => 'set', 'stock' => 15, 'description' => 'Kampas rem depan'],
            ['name' => 'Busi', 'category' => 'Sparepart', 'unit' => 'pcs', 'stock' => 50, 'description' => 'Busi standar'],
            ['name' => 'AKI 12V', 'category' => 'Sparepart', 'unit' => 'unit', 'stock' => 10, 'description' => 'AKI kering 12V'],
            ['name' => 'Lampu Depan LED', 'category' => 'Sparepart', 'unit' => 'pcs', 'stock' => 35, 'description' => 'Lampu depan LED universal'],
            ['name' => 'Ban Luar 4x6', 'category' => 'Sparepart', 'unit' => 'pcs', 'stock' => 20, 'description' => 'Ban luar ukuran 4x6'],
            ['name' => 'Ban Dalam 4x6', 'category' => 'Sparepart', 'unit' => 'pcs', 'stock' => 25, 'description' => 'Ban dalam ukuran 4x6'],

            // Peralatan
            ['name' => 'Bor Listrik', 'category' => 'Peralatan', 'unit' => 'unit', 'stock' => 8, 'description' => 'Bor listrik 13mm'],
            ['name' => 'Gerinda Tangan', 'category' => 'Peralatan', 'unit' => 'unit', 'stock' => 6, 'description' => 'Gerinda tangan 4 inch'],
            ['name' => 'Las Listrik', 'category' => 'Peralatan', 'unit' => 'unit', 'stock' => 4, 'description' => 'Mesin las listrik 900W'],
            ['name' => 'Mesin Potong Keramik', 'category' => 'Peralatan', 'unit' => 'unit', 'stock' => 5, 'description' => 'Mesin potong keramik manual'],
            ['name' => 'Cangkul', 'category' => 'Peralatan', 'unit' => 'pcs', 'stock' => 30, 'description' => 'Cangkul besi'],
            ['name' => 'Sekop', 'category' => 'Peralatan', 'unit' => 'pcs', 'stock' => 25, 'description' => 'Sekop bulat'],
            ['name' => 'Palu', 'category' => 'Peralatan', 'unit' => 'pcs', 'stock' => 40, 'description' => 'Palu kambing'],
            ['name' => 'Obeng Set', 'category' => 'Peralatan', 'unit' => 'set', 'stock' => 15, 'description' => 'Set obeng komplet'],
            ['name' => 'Tang Kombinasi', 'category' => 'Peralatan', 'unit' => 'pcs', 'stock' => 20, 'description' => 'Tang kombinasi 10 inch'],
            ['name' => 'Meteran', 'category' => 'Peralatan', 'unit' => 'pcs', 'stock' => 35, 'description' => 'Meteran pita 5m'],

            // Material Proyek
            ['name' => 'Keramik Lantai 40x40', 'category' => 'Material Proyek', 'unit' => 'dus', 'stock' => 80, 'description' => 'Keramik lantai putih 40x40 cm'],
            ['name' => 'Keramik Dinding 25x40', 'category' => 'Material Proyek', 'unit' => 'dus', 'stock' => 60, 'description' => 'Keramik dinding putih 25x40 cm'],
            ['name' => 'Granit 60x60', 'category' => 'Material Proyek', 'unit' => 'dus', 'stock' => 40, 'description' => 'Granit lantai 60x60 cm'],
            ['name' => 'Kusen Kayu', 'category' => 'Material Proyek', 'unit' => 'unit', 'stock' => 25, 'description' => 'Kusen pintu kayu meranti'],
            ['name' => 'Daun Pintu', 'category' => 'Material Proyek', 'unit' => 'unit', 'stock' => 20, 'description' => 'Daun pintu kayu'],
            ['name' => 'Jendela Aluminium', 'category' => 'Material Proyek', 'unit' => 'unit', 'stock' => 15, 'description' => 'Jendela aluminium kaca polos'],
            ['name' => 'Genteng Keramik', 'category' => 'Material Proyek', 'unit' => 'pcs', 'stock' => 800, 'description' => 'Genteng keramik kanmuri'],
            ['name' => 'Rangka Atap Baja Ringan', 'category' => 'Material Proyek', 'unit' => 'set', 'stock' => 5, 'description' => 'Rangka atap baja ringan'],
        ];

        foreach ($items as $item) {
            $category = Category::where('name', $item['category'])->first();
            $unit = Unit::where('name', $item['unit'])->first();

            if ($category && $unit) {
                Item::firstOrCreate(
                    [
                        'code' => 'ITM-'.strtoupper(substr(Str::slug($item['name'], ''), 0, 8)).'-'.rand(1000, 9999),
                    ],
                    [
                        'name' => $item['name'],
                        'stock' => $item['stock'],
                        'category_id' => $category->id,
                        'unit_id' => $unit->id,
                        'description' => $item['description'],
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
