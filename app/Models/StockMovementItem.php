<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockMovementItem extends Model
{
    protected $fillable = [
        'stock_movement_id',
        'item_id',
        'quantity',
        'unit',
        'price',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'decimal:2',
            'price' => 'decimal:2',
        ];
    }

    public function stockMovement(): BelongsTo
    {
        return $this->belongsTo(StockMovement::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
