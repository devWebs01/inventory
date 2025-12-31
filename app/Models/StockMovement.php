<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockMovement extends Model
{
    protected $fillable = [
        'code',
        'movement_date',
        'type',
        'source',
        'notes',
        'created_by',
        'attachments',
    ];

    protected function casts(): array
    {
        return [
            'movement_date' => 'date',
            'attachments' => 'array',
        ];
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function items(): HasMany
    {
        return $this->hasMany(StockMovementItem::class, 'stock_movement_id');
    }
}
