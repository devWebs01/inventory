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
                Section::make('Informasi Kategori')
                    ->description('Kelola data kategori untuk pengelompokan barang')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->placeholder('Contoh: Semen, Bata, Cat, dll.')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->autocomplete(false),
                        Select::make('type')
                            ->label('Tipe Kategori')
                            ->options([
                                'asset' => 'Aset',
                                'inventory' => 'Barang / Persediaan',
                                'both' => 'Aset & Barang',
                                'other' => 'Lainnya',
                            ])
                            ->searchable()
                            ->required()
                            ->default('asset')
                            ->native(false),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
