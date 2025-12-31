<?php

namespace App\Filament\Resources\StockIns;

use App\Filament\Resources\StockIns\Pages\CreateStockIn;
use App\Filament\Resources\StockIns\Pages\EditStockIn;
use App\Filament\Resources\StockIns\Pages\ListStockIns;
use App\Filament\Resources\StockIns\Pages\ViewStockIn;
use App\Filament\Resources\StockIns\Schemas\StockInForm;
use App\Filament\Resources\StockIns\Schemas\StockInInfolist;
use App\Filament\Resources\StockIns\Tables\StockInsTable;
use App\Models\StockMovement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StockInResource extends Resource
{
    protected static ?string $model = StockMovement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowDownTray;

    protected static ?string $navigationLabel = 'Stock In';

    protected static ?string $modelLabel = 'Stock In';

    protected static ?string $pluralModelLabel = 'Stock In';

    protected static ?int $navigationSort = 4;

    protected static string|\UnitEnum|null $navigationGroup = 'Inventory';

    public static function form(Schema $schema): Schema
    {
        return StockInForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return StockInInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StockInsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('type', 'in');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStockIns::route('/'),
            'create' => CreateStockIn::route('/create'),
            'view' => ViewStockIn::route('/{record}'),
            'edit' => EditStockIn::route('/{record}/edit'),
        ];
    }
}
