<?php

namespace App\Filament\Resources\StockOuts\Schemas;

use App\Models\Category;
use App\Models\Unit;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StockOutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Transaksi')
                    ->description('Kelola detail transaksi barang keluar')
                    ->schema([
                        DatePicker::make('movement_date')
                            ->label('Tanggal Transaksi')
                            ->required()
                            ->native(false)
                            ->default(now())
                            ->closeOnDateSelection()
                            ->columnSpanFull(),
                        Select::make('created_by')
                            ->label('Dibuat Oleh')
                            ->relationship('createdBy', 'name')
                            ->disabled()
                            ->visibleOn('edit')
                            ->columnSpanFull(),
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
                                            ->placeholder('Contoh: Semen Portland 50kg')
                                            ->required()
                                            ->maxLength(255)
                                            ->autocomplete(false)
                                            ->columnSpanFull(),
                                        Select::make('category_id')
                                            ->label('Kategori')
                                            ->options(
                                                Category::query()
                                                    ->whereIn('type', ['inventory', 'both'])
                                                    ->get()
                                                    ->mapWithKeys(function ($category) {
                                                        $color = match ($category->type) {
                                                            'inventory' => '#10b981',
                                                            'both' => '#8b5cf6',
                                                            default => '#6b7280',
                                                        };

                                                        return [
                                                            $category->id => "{$category->name} <span style=\"color:{$color};font-weight:bold;font-size:0.75em\">[".self::getTypeLabel($category->type).']</span>',
                                                        ];
                                                    })
                                                    ->toArray()
                                            )
                                            ->placeholder('Pilih kategori')
                                            ->required()
                                            ->allowHtml()
                                            ->searchable()
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
                                                    ->default('inventory'),
                                            ])
                                            ->columnSpanFull(),
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
                                    ]),

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

    private static function getTypeLabel(string $type): string
    {
        return match ($type) {
            'asset' => 'Aset',
            'inventory' => 'Barang / Persediaan',
            'both' => 'Aset & Barang',
            'other' => 'Lainnya',
            default => $type,
        };
    }
}
