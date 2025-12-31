<?php

namespace App\Observers;

use App\Models\StockMovementItem;

class StockMovementItemObserver
{
    /**
     * Handle the StockMovementItem "created" event.
     */
    public function created(StockMovementItem $stockMovementItem): void
    {
        $this->updateStock($stockMovementItem, 'create');
    }

    /**
     * Handle the StockMovementItem "updated" event.
     */
    public function updated(StockMovementItem $stockMovementItem): void
    {
        $this->updateStock($stockMovementItem, 'update');
    }

    /**
     * Handle the StockMovementItem "deleted" event.
     */
    public function deleted(StockMovementItem $stockMovementItem): void
    {
        $this->updateStock($stockMovementItem, 'delete');
    }

    /**
     * Update item stock based on operation.
     */
    protected function updateStock(StockMovementItem $stockMovementItem, string $operation): void
    {
        $item = $stockMovementItem->item;
        $quantity = $stockMovementItem->quantity;
        $movementType = $stockMovementItem->stockMovement->type ?? null;

        if (! $item || ! $movementType) {
            return;
        }

        match ($operation) {
            'create' => $this->adjustStock($item, $quantity, $movementType),
            'update' => $this->handleUpdate($stockMovementItem, $item),
            'delete' => $this->adjustStock($item, $quantity, $movementType, reverse: true),
            default => null,
        };
    }

    /**
     * Handle update operation by calculating the difference.
     */
    protected function handleUpdate(StockMovementItem $stockMovementItem, $item): void
    {
        $originalQuantity = $stockMovementItem->getOriginal('quantity');
        $newQuantity = $stockMovementItem->quantity;
        $movementType = $stockMovementItem->stockMovement->type;

        // Revert the original quantity
        $this->adjustStock($item, $originalQuantity, $movementType, reverse: true);

        // Apply the new quantity
        $this->adjustStock($item, $newQuantity, $movementType);
    }

    /**
     * Adjust item stock.
     */
    protected function adjustStock($item, $quantity, $movementType, bool $reverse = false): void
    {
        $type = $reverse ? ($movementType === 'in' ? 'out' : 'in') : $movementType;

        $item->stock = match ($type) {
            'in' => $item->stock + $quantity,
            'out' => max(0, $item->stock - $quantity),
            default => $item->stock,
        };

        $item->saveQuietly();
    }
}
