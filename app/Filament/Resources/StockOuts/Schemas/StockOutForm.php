<?php

namespace App\Filament\Resources\StockOuts\Schemas;

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

class StockOutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Transaksi')
                    ->description('Kelola detail transaksi barang keluar')
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Transaksi')
                            ->placeholder('Klik untuk generate')
                            ->suffixAction(
                                Action::make('generate')
                                    ->icon('heroicon-m-arrow-path')
                                    ->label('Generate')
                                    ->action(
                                        fn ($set) => $set('code', 'OUT-'.strtoupper(Str::random(8)))
                                    )
                            )
                            ->required()
                            ->default(fn () => 'OUT-'.strtoupper(Str::random(8)))
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->autocomplete(false)
                            ->disabled()
                            ->dehydrated(),
                        DatePicker::make('movement_date')
                            ->label('Tanggal Transaksi')
                            ->required()
                            ->native(false)
                            ->default(now())
                            ->closeOnDateSelection(),
                        TextInput::make('source')
                            ->label('Tujuan/Proyek')
                            ->placeholder('Contoh: Proyek A, Gudang B, Lokasi C')
                            ->maxLength(255)
                            ->autocomplete(false)
                            ->required(),
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
                            ->directory('stock-out-attachments')
                            ->columnSpanFull(),
                        TextInput::make('type')
                            ->default('out')
                            ->hidden()
                            ->dehydrated(),
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
                    ->description('Tambahkan barang untuk transaksi barang keluar')
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
                                    ->createOptionForm([
                                        TextInput::make('name')
                                            ->label('Nama Barang')
                                            ->required()
                                            ->autocomplete(false),

                                        Select::make('unit_id')
                                            ->label('Satuan')
                                            ->relationship('unit', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload(),

                                        Select::make('category_id')
                                            ->label('Kategori')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload(),

                                        Textarea::make('description')
                                            ->label('Deskripsi')
                                            ->rows(2),
                                    ])
                                    ->columnSpanFull(),

                                TextInput::make('quantity')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0.01)
                                    ->step(0.01)
                                    ->default(1)
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
