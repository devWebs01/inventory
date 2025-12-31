<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ItemForm
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
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Select::make('unit_id')
                            ->relationship('unit', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        Textarea::make('description')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->required()
                            ->default(true),
                    ]),
            ]);
    }
}
