<?php

namespace App\Filament\Resources\Assets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AssetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Aset Tetap')
                    ->description('Kelola data aset tetap perusahaan')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Aset')
                            ->placeholder('Contoh: Excavator CAT 320D')
                            ->required()
                            ->maxLength(255)
                            ->autocomplete(false)
                            ->columnSpanFull(),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->relationship(
                                name: 'category',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn ($query) => $query->whereIn('type', ['asset', 'both'])
                            )
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
                        TextInput::make('purchase_price')
                            ->label('Harga Perolehan')
                            ->placeholder('0')
                            ->required()
                            ->numeric()
                            ->prefix('Rp')
                            ->minValue(0)
                            ->step(0.01),
                        DatePicker::make('purchase_date')
                            ->label('Tanggal Perolehan')
                            ->placeholder('Pilih tanggal')
                            ->required()
                            ->native(false)
                            ->displayFormat('d M Y')
                            ->maxDate(now()),
                        Select::make('condition')
                            ->label('Kondisi')
                            ->placeholder('Pilih kondisi')
                            ->required()
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak Ringan' => 'Rusak Ringan',
                                'Rusak Berat' => 'Rusak Berat',
                            ])
                            ->default('Baik'),
                        Textarea::make('notes')
                            ->label('Catatan')
                            ->placeholder('Keterangan tambahan tentang aset...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
