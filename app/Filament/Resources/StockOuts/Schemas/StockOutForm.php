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
                Section::make('Transaction Information')
                    ->description('Manage outgoing stock transaction details')
                    ->schema([
                        TextInput::make('code')
                            ->label('Transaction Code')
                            ->placeholder('Click to generate')
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
                            ->label('Transaction Date')
                            ->required()
                            ->native(false)
                            ->default(now())
                            ->closeOnDateSelection(),
                        TextInput::make('source')
                            ->label('Destination/Project')
                            ->placeholder('e.g. Project A, Warehouse B, Site C')
                            ->maxLength(255)
                            ->autocomplete(false)
                            ->required(),
                        Textarea::make('notes')
                            ->label('Notes')
                            ->placeholder('Additional notes about this transaction...')
                            ->rows(3)
                            ->columnSpanFull(),
                        FileUpload::make('attachments')
                            ->label('Attachments')
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
                            ->label('Created By')
                            ->relationship('createdBy', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(auth()->id())
                            ->hidden(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Items Detail')
                    ->description('Add items for this stock out transaction')
                    ->schema([
                        Repeater::make('items')
                            ->relationship()
                            ->schema([
                                Select::make('item_id')
                                    ->label('Item')
                                    ->relationship('item', 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->reactive()
                                    ->createOptionForm([
                                        TextInput::make('code')
                                            ->label('Item Code')
                                            ->default(fn () => 'ITM-'.strtoupper(Str::random(8)))
                                            ->required()
                                            ->unique(ignoreRecord: true)
                                            ->disabled(),

                                        TextInput::make('name')
                                            ->label('Item Name')
                                            ->required()
                                            ->autocomplete(false),

                                        Select::make('unit_id')
                                            ->label('Unit')
                                            ->relationship('unit', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload(),

                                        Select::make('category_id')
                                            ->label('Category')
                                            ->relationship('category', 'name')
                                            ->required()
                                            ->searchable()
                                            ->preload(),

                                        Textarea::make('description')
                                            ->label('Description')
                                            ->rows(2),
                                    ])
                                    ->columnSpanFull(),

                                TextInput::make('quantity')
                                    ->label('Quantity')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0.01)
                                    ->step(0.01)
                                    ->default(1)
                                    ->autocomplete(false),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->addActionLabel('Add Item')
                            ->reorderable(false)
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
