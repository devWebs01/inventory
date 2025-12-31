<?php

namespace App\Providers;

use App\Models\StockMovement;
use App\Models\StockMovementItem;
use App\Observers\StockMovementItemObserver;
use App\Observers\StockMovementObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        StockMovement::observe(StockMovementObserver::class);
        StockMovementItem::observe(StockMovementItemObserver::class);
    }
}
