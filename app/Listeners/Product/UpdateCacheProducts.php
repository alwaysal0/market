<?php

namespace App\Listeners\Product;

use App\Events\Product\ProductCreated;
use Illuminate\Support\Facades\Cache;

class UpdateCacheProducts
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductCreated $event): void
    {
        Cache::tags(['products'])->flush();
    }
}
