<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('code')
                            ->required()
                            ->maxLength(255)
                            ->unique(),
                        DatePicker::make('movement_date')
                            ->required()
                            ->native(false),
                        Select::make('type')
                            ->required()
                            ->options([
                                'in' => 'Masuk',
                                'out' => 'Keluar',
                            ])
                            ->native(false),
                        TextInput::make('source')
                            ->maxLength(255),
                        Textarea::make('notes')
                            ->columnSpanFull(),
                        Select::make('created_by')
                            ->relationship('createdBy', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(auth()->id()),
                    ]),
            ]);
    }
}
