<?php

namespace App\Filament\Resources\Items\Schemas;

use App\Models\Unit;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Barang')
                            ->placeholder('Klik untuk generate')
                            ->suffixAction(
                                Action::make('generate')
                                    ->icon('heroicon-m-arrow-path')
                                    ->action(
                                        fn ($set) => $set('code', 'ITM-'.strtoupper(Str::random(8)))
                                    )
                            )
                            ->required()
                            ->default(fn () => 'ITM-'.strtoupper(Str::random(8)))
                            ->unique(),
                        Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Select::make('unit_id')
                            ->label('Satuan')
                            ->relationship('unit', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama Satuan')
                                    ->required()
                                    ->unique(Unit::class, 'name'),
                            ]),

                        Textarea::make('description')
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->required()
                            ->default(true),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
