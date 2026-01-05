<?php

namespace App\Filament\Resources\StockOuts\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StockOutInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Transaksi')
                    ->description('Informasi lengkap tentang transaksi barang keluar')
                    ->schema([
                        TextEntry::make('movement_date')
                            ->label('Tanggal Transaksi')
                            ->date('d M Y'),
                        TextEntry::make('notes')
                            ->label('Catatan')
                            ->placeholder('Tidak ada catatan')
                            ->columnSpanFull(),
                        ImageEntry::make('attachments')
                            ->label('Lampiran')
                            ->visible(fn ($record) => ! empty($record->attachments))
                            ->columnSpanFull(),
                        TextEntry::make('createdBy.name')
                            ->label('Dibuat Oleh'),
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Daftar Barang')
                    ->description('Barang yang terlibat dalam transaksi ini')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                TextEntry::make('item.name')
                                    ->label('Nama Barang'),
                                TextEntry::make('item.unit.name')
                                    ->label('Satuan')
                                    ->placeholder('-'),
                                TextEntry::make('quantity')
                                    ->label('Jumlah'),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
