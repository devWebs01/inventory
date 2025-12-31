<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('code'),
                        TextEntry::make('name'),
                        TextEntry::make('stock')
                            ->numeric(),
                        TextEntry::make('unit.name'),
                        TextEntry::make('category.name'),
                        TextEntry::make('description')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        IconEntry::make('is_active')
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->dateTime()
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->dateTime()
                            ->placeholder('-'),
                    ]),
            ]);
    }
}
