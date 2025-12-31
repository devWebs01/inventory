<?php

namespace Database\Seeders;

use App\Models\StockMovement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class StockMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@testing.com')->first();

        if (! $user) {
            $user = User::first();
        }

        $movements = [
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(30)->format('Y-m-d'),
                'type' => 'in',
                'source' => 'PT. Semen Indonesia',
                'notes' => 'Penerimaan barang dari supplier semen',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(25)->format('Y-m-d'),
                'type' => 'in',
                'source' => 'PT. Beton Jaya',
                'notes' => 'Penerimaan material pasir dan batu',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(20)->format('Y-m-d'),
                'type' => 'in',
                'source' => 'PT. Krakatau Steel',
                'notes' => 'Penerimaan besi beton',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(18)->format('Y-m-d'),
                'type' => 'in',
                'source' => 'TB. Maju Jaya',
                'notes' => 'Penerimaan consumable dan sparepart',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(15)->format('Y-m-d'),
                'type' => 'out',
                'source' => 'Proyek Gedung A',
                'notes' => 'Pengiriman material untuk proyek gedung A',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(12)->format('Y-m-d'),
                'type' => 'out',
                'source' => 'Proyek Rumah Bapak Ahmad',
                'notes' => 'Pengiriman material untuk renovasi rumah',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(10)->format('Y-m-d'),
                'type' => 'in',
                'source' => 'PT. Cat Dulux',
                'notes' => 'Penerimaan cat tembok dan kayu besi',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(8)->format('Y-m-d'),
                'type' => 'in',
                'source' => 'Gudang Pusat',
                'notes' => 'Transfer barang dari gudang pusat',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(5)->format('Y-m-d'),
                'type' => 'out',
                'source' => 'Proyek Ruko C',
                'notes' => 'Pengiriman material untuk proyek ruko',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(3)->format('Y-m-d'),
                'type' => 'out',
                'source' => 'Proyek Renovasi Kantor',
                'notes' => 'Pengiriman peralatan untuk renovasi kantor',
                'created_by' => $user?->id,
            ],
            [
                'code' => 'TRX-'.strtoupper(Str::random(8)),
                'movement_date' => now()->subDays(1)->format('Y-m-d'),
                'type' => 'in',
                'source' => 'PT. Keramik Indonesia',
                'notes' => 'Penerimaan keramik dan granit',
                'created_by' => $user?->id,
            ],
        ];

        foreach ($movements as $movement) {
            StockMovement::firstOrCreate(
                ['code' => $movement['code']],
                $movement
            );
        }
    }
}
