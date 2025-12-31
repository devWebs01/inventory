<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'pcs'],
            ['name' => 'zak'],
            ['name' => 'kg'],
            ['name' => 'm3'],
            ['name' => 'liter'],
            ['name' => 'meter'],
            ['name' => 'unit'],
            ['name' => 'box'],
            ['name' => 'pack'],
            ['name' => 'roll'],
            ['name' => 'dus'],
            ['name' => 'kaleng'],
            ['name' => 'karung'],
            ['name' => 'batang'],
            ['name' => 'lembar'],
        ];

        foreach ($units as $unit) {
            Unit::firstOrCreate(
                ['name' => $unit['name']],
                $unit
            );
        }
    }
}
