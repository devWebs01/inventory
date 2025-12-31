<?php

namespace App\Filament\Resources\StockMovements\Schemas;

use App\Models\Item;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
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
                Section::make()
                    ->schema([
                        TextInput::make('code')
                            ->label('Kode Barang')
                            ->placeholder('Klik untuk generate')
                            ->suffixAction(
                                Action::make('generate')
                                    ->icon('heroicon-m-arrow-path')
                                    ->action(
                                        fn ($set) => $set('code', 'ITM-'.strtoupper(Str::random(8)))
                                    )
                            )
                            ->required()
                            ->default(fn () => 'ITM-'.strtoupper(Str::random(8)))
                            ->unique(),
                        DatePicker::make('movement_date')
                            ->required()
                            ->native(false)
                            ->default(now()),
                        Select::make('type')
                            ->required()
                            ->options([
                                'in' => 'Masuk',
                                'out' => 'Keluar',
                            ])
                            ->native(false),
                        TextInput::make('source')
                            ->maxLength(255),
                        Textarea::make('notes')
                            ->columnSpanFull(),

                        FileUpload::make('attachments')
                            ->multiple(),
                        Select::make('created_by')
                            ->relationship('createdBy', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->default(auth()->id())
                            ->hidden(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

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
                                TextInput::make('code')
                                    ->default(fn () => 'ITM-'.strtoupper(Str::random(8)))
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('name')
                                    ->required(),

                                Select::make('unit_id')
                                    ->label('Satuan')
                                    ->relationship('unit', 'name')
                                    ->required(),

                                Select::make('category_id')
                                    ->relationship('category', 'name')
                                    ->required(),

                                Textarea::make('description'),
                            ])
                            ->columnSpanFull(),

                        Placeholder::make('unit')
                            ->label('Satuan')
                            ->content(
                                fn ($get) => Item::find($get('item_id'))?->unit?->name ?? '-'
                            ),

                        TextInput::make('quantity')
                            ->label('Jumlah')
                            ->numeric()
                            ->required()
                            ->minValue(1),

                    ])
                    ->columns(4)
                    ->defaultItems(1)
                    ->addActionLabel('Tambah Barang')
                    ->reorderable(false)
                    ->columnSpanFull(),
            ]);
    }
}
