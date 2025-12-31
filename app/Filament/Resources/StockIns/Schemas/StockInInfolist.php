<?php

namespace App\Filament\Resources\StockIns\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StockInInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Transaction Details')
                    ->description('Complete information about stock in transaction')
                    ->schema([
                        TextEntry::make('code')
                            ->label('Transaction Code'),
                        TextEntry::make('movement_date')
                            ->label('Transaction Date')
                            ->date('d M Y'),
                        TextEntry::make('source')
                            ->label('Supplier')
                            ->placeholder('-'),
                        TextEntry::make('notes')
                            ->label('Notes')
                            ->placeholder('No notes')
                            ->columnSpanFull(),
                        ImageEntry::make('attachments')
                            ->label('Attachments')
                            ->visible(fn ($record) => ! empty($record->attachments))
                            ->columnSpanFull(),
                        TextEntry::make('createdBy.name')
                            ->label('Created By'),
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime('d M Y H:i')
                            ->placeholder('-'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                Section::make('Items List')
                    ->description('Items involved in this transaction')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->label('')
                            ->schema([
                                TextEntry::make('item.name')
                                    ->label('Item Name'),
                                TextEntry::make('item.unit.name')
                                    ->label('Unit')
                                    ->placeholder('-'),
                                TextEntry::make('quantity')
                                    ->label('Quantity'),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
