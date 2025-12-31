<?php

namespace App\Filament\Resources\Items\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Barang')
                    ->description('Informasi lengkap tentang barang')
                    ->schema([
                        TextEntry::make('code')
                            ->label('Kode Barang'),
                        TextEntry::make('name')
                            ->label('Nama Barang')
                            ->columnSpanFull(),
                        TextEntry::make('category.name')
                            ->label('Kategori'),
                        TextEntry::make('stock')
                            ->label('Stok Saat Ini')
                            ->numeric()
                            ->badge()
                            ->color(fn (string $state): string => (int) $state > 10 ? 'success' : ((int) $state > 0 ? 'warning' : 'danger')),
                        TextEntry::make('unit.name')
                            ->label('Satuan'),
                        TextEntry::make('description')
                            ->label('Deskripsi')
                            ->placeholder('Tidak ada deskripsi')
                            ->columnSpanFull(),
                        IconEntry::make('is_active')
                            ->label('Status Aktif')
                            ->boolean(),
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(3),
            ]);
    }
}
