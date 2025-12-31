<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use App\Models\Item;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class StockMovementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Transaksi')
                    ->description('Kelola data mutasi stok barang masuk dan keluar')
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Transaksi')
                            ->placeholder('Klik untuk generate')
                            ->suffixAction(
                                Action::make('generate')
                                    ->icon('heroicon-m-arrow-path')
                                    ->label('Generate')
                                    ->action(
                                        fn ($set) => $set('code', 'TRX-'.strtoupper(Str::random(8)))
                                    )
                            )
                            ->required()
                            ->default(fn () => 'TRX-'.strtoupper(Str::random(8)))
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->autocomplete(false),
                        DatePicker::make('movement_date')
                            ->label('Tanggal Transaksi')
                            ->required()
                            ->native(false)
                            ->default(now())
                            ->closeOnDateSelection(),
                        Select::make('type')
                            ->label('Tipe Mutasi')
                            ->required()
                            ->options([
                                'in' => 'Masuk',
                                'out' => 'Keluar',
                            ])
                            ->native(false)
                            ->default('in'),
                        TextInput::make('source')
                            ->label('Sumber/Tujuan')
                            ->placeholder('Contoh: Supplier ABC, Gudang A, Proyek X')
                            ->maxLength(255)
                            ->autocomplete(false),
                        Textarea::make('notes')
                            ->label('Catatan')
                            ->placeholder('Catatan tambahan tentang transaksi...')
                            ->rows(3)
                            ->columnSpanFull(),
                        FileUpload::make('attachments')
                            ->label('Lampiran')
                            ->multiple()
                            ->downloadable()
                            ->openable()
                            ->directory('stock-movement-attachments')
                            ->columnSpanFull(),
                        Select::make('created_by')
                            ->label('Dibuat Oleh')
                            ->relationship('createdBy', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(auth()->id())
                            ->hidden(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Detail Barang')
                    ->description('Tambahkan barang yang akan dimutasi')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('item_id')
                                    ->label('Barang')
                                    ->relationship('item', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, $set) {
                                        $unitName = Item::find($state)?->unit?->name ?? '-';

                                        $set('unit_placeholder', $unitName);
                                    })
                                    ->createOptionForm([
                                        TextInput::make('code')
                                            ->label('Kode Barang')
                                            ->default(fn () => 'ITM-'.strtoupper(Str::random(8)))
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->disabled(),

                                        TextInput::make('name')
                                            ->label('Nama Barang')
                                            ->required(),

                                        Select::make('unit_id')
                                            ->label('Satuan')
                                            ->relationship('unit', 'name')
                                            ->required(),

                                        Select::make('category_id')
                                            ->label('Kategori')
                                            ->relationship('category', 'name')
                                            ->required(),
                                    ]),
                                TextInput::make('unit_placeholder')
                                    ->label('Satuan')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->default('-'),

                                TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0.01)
                                    ->step(0.01)
                                    ->default(1)
                                    ->autocomplete(false),

                                TextInput::make('price')
                                    ->label('Harga Satuan')
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->minValue(0)
                                    ->step(0.01)
                                    ->autocomplete(false),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->addActionLabel('Tambah Barang')
                            ->reorderable(false)
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
