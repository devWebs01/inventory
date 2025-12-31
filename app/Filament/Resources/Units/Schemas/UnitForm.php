<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Satuan')
                    ->description('Kelola data satuan barang seperti pcs, zak, kg, m3, dll.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Satuan')
                            ->placeholder('Contoh: pcs, zak, kg, m3')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->autocomplete(false),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
