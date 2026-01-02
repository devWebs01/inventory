<?php

namespace App\Filament\Resources\Items\Schemas;

use App\Models\Unit;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Barang')
                    ->description('Kelola data barang atau persediaan')
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Barang')
                            ->placeholder('Klik untuk generate')
                            ->suffixAction(
                                Action::make('generate')
                                    ->icon('heroicon-m-arrow-path')
                                    ->label('Generate')
                                    ->action(
                                        fn ($set) => $set('code', 'ITM-'.strtoupper(Str::random(8)))
                                    )
                            )
                            ->required()
                            ->default(fn () => 'ITM-'.strtoupper(Str::random(8)))
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->autocomplete(false),
                        TextInput::make('name')
                            ->label('Nama Barang')
                            ->placeholder('Contoh: Semen Portland 50kg')
                            ->required()
                            ->maxLength(255)
                            ->autocomplete(false)
                            ->columnSpanFull(),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship('category', 'name')
                            ->placeholder('Pilih kategori')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->label('Nama Kategori')
                                    ->required()
                                    ->unique(ignoreRecord: true),
                                Select::make('type')
                                    ->label('Tipe Kategori')
                                    ->options([
                                        'asset' => 'Aset',
                                        'inventory' => 'Barang / Persediaan',
                                        'both' => 'Aset & Barang',
                                        'other' => 'Lainnya',
                                    ])
                                    ->required()
                                    ->default('asset'),
                            ]),
                        TextInput::make('stock')
                            ->label('Stok Saat Ini')
                            ->placeholder('0')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->minValue(0),
                        Select::make('unit_id')
                            ->label('Satuan')
                            ->relationship('unit', 'name')
                            ->placeholder('Pilih satuan')
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
                            ->label('Deskripsi')
                            ->placeholder('Keterangan tambahan tentang barang...')
                            ->rows(3)
                            ->columnSpanFull(),

                    ])
                    ->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
