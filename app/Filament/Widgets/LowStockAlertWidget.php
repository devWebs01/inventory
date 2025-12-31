<?php

namespace App\Filament\Widgets;

use App\Models\Item;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LowStockAlertWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getStats(): array
    {
        $lowStockThreshold = config('inventory.low_stock_threshold', 10);
        $lowStockCount = Item::where('current_stock', '<=', $lowStockThreshold)->count();
        $outOfStockCount = Item::where('current_stock', '=', 0)->count();

        return [
            Stat::make('Stok Menipis', $lowStockCount)
                ->description('Item di bawah ambang batas')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('warning')
                ->chart([7, 5, 8, $lowStockCount]),
            Stat::make('Stok Habis', $outOfStockCount)
                ->description('Item dengan stok 0')
                ->descriptionIcon('heroicon-o-x-circle')
                ->color('danger'),
        ];
    }
}
