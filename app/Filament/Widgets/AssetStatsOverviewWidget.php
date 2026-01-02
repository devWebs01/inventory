<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class AssetStatsOverviewWidget extends BaseWidget
{
    protected static ?string $heading = 'Ringkasan Aset Tetap';

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $totalAssets = Asset::count();
        $totalValue = Asset::sum('purchase_price');
        $goodCondition = Asset::where('condition', 'Baik')->count();
        $slightlyDamaged = Asset::where('condition', 'Rusak Ringan')->count();
        $heavilyDamaged = Asset::where('condition', 'Rusak Berat')->count();

        return $table
            ->query(
                Asset::query()->limit(1)
            )
            ->columns([
                TextColumn::make('total')
                    ->label('Total Aset')
                    ->state($totalAssets)
                    ->badge()
                    ->color('primary'),
                TextColumn::make('total_value')
                    ->label('Total Nilai Aset')
                    ->state('Rp '.number_format($totalValue, 0, ',', '.'))
                    ->badge()
                    ->color('success'),
                TextColumn::make('good')
                    ->label('Kondisi Baik')
                    ->state($goodCondition)
                    ->badge()
                    ->color('success'),
                TextColumn::make('slightly_damaged')
                    ->label('Rusak Ringan')
                    ->state($slightlyDamaged)
                    ->badge()
                    ->color('warning'),
                TextColumn::make('heavily_damaged')
                    ->label('Rusak Berat')
                    ->state($heavilyDamaged)
                    ->badge()
                    ->color('danger'),
                TextColumn::make('avg_value')
                    ->label('Rata-rata Nilai')
                    ->state($totalAssets > 0 ? 'Rp '.number_format($totalValue / $totalAssets, 0, ',', '.') : 'Rp 0')
                    ->badge()
                    ->color('info'),
            ])
            ->paginated(false);
    }
}
