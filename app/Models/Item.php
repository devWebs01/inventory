<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Item extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'unit_id',
        'category_id',
        'description',
        'image',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovementItems(): HasMany
    {
        return $this->hasMany(StockMovementItem::class);
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => $value ? Storage::disk('public')->url($value) : null,
        );
    }
}
