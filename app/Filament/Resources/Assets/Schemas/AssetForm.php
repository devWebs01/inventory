<?php

namespace App\Filament\Resources\Assets\Schemas;

use App\Models\Category;
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
                            ->autocomplete(false),
                        Select::make('category_id')
                            ->label('Kategori')
                            ->options(
                                Category::query()
                                    ->whereIn('type', ['asset', 'both'])
                                    ->get()
                                    ->mapWithKeys(function ($category) {
                                        $color = match ($category->type) {
                                            'asset' => '#3b82f6',
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
                                    ->default('asset'),
                            ]),
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
                            ->label('Catatan (Opsional)')
                            ->placeholder('Keterangan tambahan tentang aset...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
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
