<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define image URLs for items
        $itemImages = [
            // Material Bangunan
            'Semen Portland 50kg' => 'https://siplah-oss.tokoladang.co.id/merchant/33419/product/O0HJSXeuxvYH9FnYLpQrqaD5Qx5xftpHfmj3sPSf.webp',
            'Semen Gresik 50kg' => 'https://gemilang-store.com/images/cimage/webroot/img.php?src=..//images/838/_assets/products/215000001/215000001.png&width=1400&height=1050&fill-to-fit=ffffff&force-bg=1&bg-color=ffffff&watermark=1&watermark_url=https://gemilang-store.com/_assets/images/watermark.png',
            'Bata Merah' => 'https://udssj.com/images/gallery_produk/udssj-bata-merah-press-standart42.jpeg',
            'Bata Ringan Hebel' => 'https://bintorohebel.co.id/wp-content/uploads/2023/06/HEBEL-AAC-NEW.png',
            'Pasir Beton' => 'https://static-tokodaring.tisera.id/prod/images/produk_gambar/68ff5b801b560.jpg',
            'Besi Beton 10mm' => 'https://juraganmaterial.id/static/product/f8qnlLCwEzSAuZtGdXpw3FZ88SOBF1Mj.png',

            // Consumable
            'Cat Tembok 5kg' => 'https://images.tokopedia.net/img/cache/700/aphluv/1997/1/1/77db3c991f17474aa2452b29e332bc45~.jpeg',
            'Kabel Listrik 1.5mm' => 'https://bosara.sultraprov.go.id/asset/foto_produk/product-toko-avo-listrik-dan-elektronik-20240515073546189.jpg',
            'Stop Kontak' => 'https://images.tokopedia.net/img/cache/700/VqbcmM/2023/7/12/557770a6-3f5e-4245-9767-9bce739b6e6f.png',

            // Sparepart
            'Oli Mesin 1L' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/98/MTA-155077135/pertamina_pertamina_pelumas_mesin_mobil_bensin_-_mesran_-_prima_xp_-_fastron_kemasan_isi_1_liter_full05_saxzvs8.jpg',
            'AKI 12V' => 'https://otoklix-production.s3.amazonaws.com/uploads/2022/09/harga-aki-kering.jpg',
            'Ban Luar 4x6' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/94/MTA-160870223/pertamina_oli_mesran_sae_40_1lt_pertamina_oil_full04_iudavqce.jpg', // placeholder sementara (oli), karena hasil ban kurang bagus – ganti manual kalau perlu

            // Peralatan
            'Bor Listrik' => 'https://www.cnindonesia.com/image-product/img27-1400166484.jpg',
            'Gerinda Tangan' => 'https://img.lazcdn.com/g/p/2c0b3a9d793baca784a66088c0166aef.jpg_720x720q80.jpg',
            'Palu' => 'https://www.pratamabangunan.id/contents/product_detailbmz6tG20160811161822.JPG',

            // Material Proyek
            'Keramik Lantai 40x40' => 'https://cdn.brighton.co.id/Uploads/Images/5795267/modadUp0/harga-keramik-40x40.webp',
            'Keramik Dinding 25x40' => 'https://www.qhomemart.com/wp-content/uploads/2024/10/f7dba00c-f5bd-4dc8-842a-4a184941084c.jpg',
            'Genteng Keramik' => 'https://sakaabadi.com/wp-content/uploads/2022/02/IMG_20200406_135723-scaled.jpg',
        ];

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

        // ... di dalam method run()

        foreach ($items as $item) {
            $category = Category::where('name', $item['category'])->first();
            $unit = Unit::where('name', $item['unit'])->first();

            if (! $category || ! $unit) {
                // Skip kalau category/unit tidak ada
                continue;
            }

            $imagePath = null;

            if (isset($itemImages[$item['name']])) {
                try {
                    $imageUrl = $itemImages[$item['name']];

                    $response = Http::timeout(30)
                        ->withHeaders(['User-Agent' => 'Laravel Seeder'])
                        ->get($imageUrl);

                    if ($response->successful() && $response->header('Content-Type') !== 'text/html') {
                        $imageContents = $response->body();

                        // Ambil ekstensi dari URL atau dari content-type
                        $extension = pathinfo(parse_url($imageUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
                        if (empty($extension)) {
                            $contentType = $response->header('Content-Type');
                            $extension = match (true) {
                                str_contains($contentType, 'jpeg') => 'jpg',
                                str_contains($contentType, 'png') => 'png',
                                str_contains($contentType, 'webp') => 'webp',
                                default => 'jpg',
                            };
                        }

                        $fileName = 'items/'.Str::slug($item['name']).'-'.Str::random(8).'.'.$extension;
                        Storage::disk('public')->put($fileName, $imageContents);
                        $imagePath = $fileName;
                    } else {
                        Log::warning("Gagal download gambar untuk {$item['name']}: HTTP {$response->status()}");
                    }
                } catch (\Exception $e) {
                    Log::warning("Exception saat download gambar {$item['name']}: ".$e->getMessage());
                }
            }

            Item::updateOrCreate(
                ['name' => $item['name']], // unique key
                [
                    'stock' => $item['stock'],
                    'category_id' => $category->id,
                    'unit_id' => $unit->id,
                    'description' => $item['description'] ?? null,
                    'image' => $imagePath,
                ]
            );
        }
    }
}
