<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminDeletedProduct;
use App\Models\Product;

class LogAdminDeletingProduct
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
    public function handle(AdminDeletedProduct $event): void
    {
        $admin = $event->admin;
        $product_data = $event->product_data;

        activity('admin')
            ->causedBy($admin)
            ->withProperties([
                'admin' => $admin->username,
                'product_data' => $product_data,
            ])
        ->log("Admin has deleted product.");
    }
}
