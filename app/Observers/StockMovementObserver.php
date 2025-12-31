<?php

namespace App\Observers;

use App\Models\StockMovement;

class StockMovementObserver
{
    /**
     * Handle the StockMovement "deleted" event.
     * When a StockMovement is deleted, all related StockMovementItems
     * will be automatically deleted by cascade, and each will trigger
     * the StockMovementItemObserver to revert the stock.
     *
     * This observer can be used for other logic related to StockMovement.
     */
    public function deleted(StockMovement $stockMovement): void
    {
        // Stock items are handled by StockMovementItemObserver
        // via cascade delete, so no additional action needed here.
        // This method exists for future custom logic if needed.
    }
}
