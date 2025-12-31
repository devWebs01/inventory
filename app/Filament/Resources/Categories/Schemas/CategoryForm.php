<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('-')
                    ->description('-')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('type')
                            ->options([
                                'asset' => 'Aset',
                                'inventory' => 'Barang / Persediaan',
                                'both' => 'Aset & Barang',
                                'other' => 'Lainnya',
                            ])

                            ->searchable()
                            ->required()
                            ->default('asset'),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
