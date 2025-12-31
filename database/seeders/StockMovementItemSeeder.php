<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\StockMovement;
use App\Models\StockMovementItem;
use Illuminate\Database\Seeder;

class StockMovementItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movements = StockMovement::all();

        foreach ($movements as $movement) {
            $items = [];

            if ($movement->type === 'in') {
                // Stock masuk - tambahkan barang berdasarkan sumber
                if (str_contains($movement->source, 'Semen')) {
                    $item = Item::where('name', 'like', '%Semen%')->first();
                    if ($item) {
                        $items[] = [
                            'item_id' => $item->getKey(),
                            'quantity' => 100,

                        ];
                    }
                }

                if (str_contains($movement->source, 'Beton') || str_contains($movement->source, 'Pasir')) {
                    $item = Item::where('name', 'like', '%Pasir%')->first();
                    if ($item) {
                        $items[] = [
                            'item_id' => $item->getKey(),
                            'quantity' => 5,

                        ];
                    }
                }

                if (str_contains($movement->source, 'Steel') || str_contains($movement->source, 'Besi')) {
                    $item = Item::where('name', 'like', '%Besi Beton%')->first();
                    if ($item) {
                        $items[] = [
                            'item_id' => $item->getKey(),
                            'quantity' => 50,

                        ];
                    }
                }

                if (str_contains($movement->source, 'Maju')) {
                    $itemsToFind = [
                        ['name' => 'Paku 7cm', 'qty' => 10, 'price' => 15000],
                        ['name' => 'Cat Tembok 5kg', 'qty' => 20, 'price' => 85000],
                        ['name' => 'Oli Mesin 1L', 'qty' => 15, 'price' => 55000],
                    ];
                    foreach ($itemsToFind as $itemData) {
                        $item = Item::where('name', $itemData['name'])->first();
                        if ($item) {
                            $items[] = [
                                'item_id' => $item->getKey(),
                                'quantity' => $itemData['qty'],
                            ];
                        }
                    }
                }

                if (str_contains($movement->source, 'Cat')) {
                    $item = Item::where('name', 'like', '%Cat Tembok%')->first();
                    if ($item) {
                        $items[] = [
                            'item_id' => $item->getKey(),
                            'quantity' => 25,

                        ];
                    }
                }

                if (str_contains($movement->source, 'Gudang')) {
                    $itemsToFind = [
                        ['name' => 'Bor Listrik', 'qty' => 2, 'price' => 350000],
                        ['name' => 'Palu', 'qty' => 10, 'price' => 45000],
                    ];
                    foreach ($itemsToFind as $itemData) {
                        $item = Item::where('name', $itemData['name'])->first();
                        if ($item) {
                            $items[] = [
                                'item_id' => $item->getKey(),
                                'quantity' => $itemData['qty'],
                            ];
                        }
                    }
                }

                if (str_contains($movement->source, 'Keramik')) {
                    $item = Item::where('name', 'like', '%Keramik Lantai%')->first();
                    if ($item) {
                        $items[] = [
                            'item_id' => $item->getKey(),
                            'quantity' => 30,

                        ];
                    }
                }
            } else {
                // Stock keluar
                $itemsToFind = [
                    ['name' => 'Semen Portland 50kg', 'qty' => 50, 'price' => null],
                    ['name' => 'Bata Merah', 'qty' => 1000, 'price' => null],
                    ['name' => 'Pasir Beton', 'qty' => 3, 'price' => null],
                ];

                if (str_contains($movement->source, 'Renovasi')) {
                    $itemsToFind[] = ['name' => 'Cat Tembok 5kg', 'qty' => 10, 'price' => null];
                    $itemsToFind[] = ['name' => 'Kuas Cat 4inch', 'qty' => 5, 'price' => null];
                }

                foreach ($itemsToFind as $itemData) {
                    $item = Item::where('name', $itemData['name'])->first();
                    if ($item) {
                        $items[] = [
                            'item_id' => $item->getKey(),
                            'quantity' => $itemData['qty'],

                        ];
                    }
                }
            }

            foreach ($items as $itemData) {
                StockMovementItem::firstOrCreate(
                    [
                        'stock_movement_id' => $movement->getKey(),
                        'item_id' => $itemData['item_id'],
                    ],
                    [
                        'quantity' => $itemData['quantity'],
                    ]
                );
            }
        }
    }
}
