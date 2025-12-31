<?php

namespace App\Filament\Widgets;

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

        return [
            Stat::make('Total Item', $totalItems)
                ->description('Semua item dalam inventaris')
                ->descriptionIcon('heroicon-o-cube')
                ->color('primary')
                ->chart([7, 2, 10, 3, 15, $totalItems])
                ->columnSpanFull(),
            Stat::make('Stok Masuk', $totalStockIn)
                ->description('Total transaksi masuk')
                ->descriptionIcon('heroicon-o-arrow-down-circle')
                ->color('success')
                ->chart([2, 4, 1, 5, 3, $totalStockIn]),
            Stat::make('Stok Keluar', $totalStockOut)
                ->description('Total transaksi keluar')
                ->descriptionIcon('heroicon-o-arrow-up-circle')
                ->color('info')
                ->chart([1, 3, 2, 4, 2, $totalStockOut]),
        ];
    }
}
