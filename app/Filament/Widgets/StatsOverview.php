<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Item;
use App\Models\StockMovement;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $totalItems = Item::count();
        $totalStockIn = StockMovement::where('type', 'in')->count();
        $totalStockOut = StockMovement::where('type', 'out')->count();
        $totalAssets = Asset::count();

        return [
            Stat::make('Total Item', $totalItems)
                ->description('Semua item dalam inventaris')
                ->descriptionIcon('heroicon-o-cube')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, $totalItems]),
            Stat::make('Total Aset', $totalAssets)
                ->description('Semua aset tetap')
                ->descriptionIcon('heroicon-o-building-office-2')
                ->color('info')
                ->chart([5, 3, 8, 2, 10, $totalAssets]),
            Stat::make('Stok Masuk', $totalStockIn)
                ->description('Total transaksi masuk')
                ->descriptionIcon('heroicon-o-arrow-down-circle')
                ->color('success')
                ->chart([2, 4, 1, 5, 3, $totalStockIn]),
            Stat::make('Stok Keluar', $totalStockOut)
                ->description('Total transaksi keluar')
                ->descriptionIcon('heroicon-o-arrow-up-circle')
                ->color('warning')
                ->chart([1, 3, 2, 4, 2, $totalStockOut]),
        ];
    }
}
