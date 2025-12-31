<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StockMovementInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Transaksi')
                    ->description('Informasi lengkap tentang mutasi stok')
                    ->schema([
                        TextEntry::make('code')
                            ->label('Kode Transaksi'),
                        TextEntry::make('movement_date')
                            ->label('Tanggal Transaksi')
                            ->date('d M Y'),

                        TextEntry::make('type')
                            ->label('Tipe Mutasi')
                            ->icon(fn (string $state): string => match ($state) {
                                'in' => 'heroicon-o-arrow-down-tray',
                                'out' => 'heroicon-o-arrow-up-tray',
                                default => 'heroicon-o-question-mark-circle',
                            })
                            ->color(fn (string $state): string => match ($state) {
                                'in' => 'success',
                                'out' => 'danger',
                                default => 'gray',
                            })
                            ->formatStateUsing(fn (string $state): string => match ($state) {
                                'in' => 'Masuk',
                                'out' => 'Keluar',
                                default => $state,
                            }),

                        TextEntry::make('source')
                            ->label('Sumber/Tujuan')
                            ->placeholder('-'),
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
                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Daftar Barang')
                    ->description('Item yang terlibat dalam transaksi ini')
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

                                TextEntry::make('price')
                                    ->label('Harga')
                                    ->money('IDR')
                                    ->placeholder('-'),
                            ])
                            ->columns(4)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

            ]);
    }
}
