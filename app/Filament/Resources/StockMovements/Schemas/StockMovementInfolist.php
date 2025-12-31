<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class StockMovementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextEntry::make('code'),
                        TextEntry::make('movement_date')
                            ->date(),
                        TextEntry::make('type')
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'in' => 'Masuk',
                                'out' => 'Keluar',
                                default => $state,
                            }),
                        TextEntry::make('source')
                            ->placeholder('-'),
                        TextEntry::make('notes')
                            ->placeholder('-')
                            ->columnSpanFull(),
                        TextEntry::make('createdBy.name'),
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
