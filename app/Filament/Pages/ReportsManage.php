<?php

namespace App\Filament\Pages;

use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use App\Models\StockMovement;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;

class ReportsManage extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static string|\UnitEnum|null $navigationGroup = 'Sirkulasi Barang';

    protected static ?string $navigationLabel = 'Laporan';

    protected static ?string $title = 'Laporan Barang';

    protected static ?int $navigationSort = 6;

    protected string $view = 'filament.pages.reports-manage';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(\Filament\Schemas\Schema $form): \Filament\Schemas\Schema
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->native(false),
                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->native(false),
                        Select::make('type')
                            ->label('Tipe')
                            ->options([
                                'in' => 'Barang Masuk',
                                'out' => 'Barang Keluar',
                            ])
                            ->placeholder('Semua'),
                        Select::make('user_id')
                            ->label('Dibuat Oleh')
                            ->options(\App\Models\User::orderBy('name')->pluck('name', 'id')->toArray())
                            ->searchable()
                            ->placeholder('Semua'),
                        TextInput::make('notes')
                            ->label('Catatan')
                            ->placeholder('Cari catatan...')
                            ->columnSpanFull(),
                    ])
                    ->columns(4),
            ])
            ->statePath('data')
            ->live();
    }

    protected function getTableQuery(): Builder
    {
        $query = StockMovement::query()
            ->with(['createdBy', 'items'])
            ->withCount('items');

        if (! empty($this->data['start_date'])) {
            $query->whereDate('movement_date', '>=', $this->data['start_date']);
        }

        if (! empty($this->data['end_date'])) {
            $query->whereDate('movement_date', '<=', $this->data['end_date']);
        }

        if (! empty($this->data['type'])) {
            $query->where('type', $this->data['type']);
        }

        if (! empty($this->data['user_id'])) {
            $query->where('user_id', $this->data['user_id']);
        }

        if (! empty($this->data['notes'])) {
            $query->where('notes', 'like', '%'.$this->data['notes'].'%');
        }

        return $query;
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('movement_date')
                ->label('Tanggal')
                ->date('d/m/Y')
                ->sortable(),
            TextColumn::make('type')
                ->label('Tipe')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'in' => 'success',
                    'out' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'in' => 'Masuk',
                    'out' => 'Keluar',
                    default => $state,
                })
                ->sortable(),
            TextColumn::make('notes')
                ->label('Catatan')
                ->limit(50)
                ->wrap(),
            TextColumn::make('items_count')
                ->label('Total Item')
                ->sortable(),
            TextColumn::make('createdBy.name')
                ->label('Dibuat Oleh')
                ->sortable()
                ->searchable(query: function (Builder $query, string $search): Builder {
                    return $query->whereHas('createdBy', function (Builder $query) use ($search) {
                        $query->where('name', 'like', '%'.$search.'%');
                    });
                }),
            TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }

    protected function getTableBulkActions(): array
    {
        return [
            FilamentExportBulkAction::make('Export')
                ->fileName('laporan-barang-'.date('Y-m-d-His')),
        ];
    }

    protected function getDefaultTableSortColumn(): string
    {
        return 'movement_date';
    }

    protected function getDefaultTableSortDirection(): string
    {
        return 'desc';
    }
}
