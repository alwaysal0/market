<?php

namespace App\Listeners\Admin;

use App\Events\Admin\AdminChangedProduct;

class LogAdminChangingProduct
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
    public function handle(AdminChangedProduct $event): void
    {
        $admin = $event->admin;
        $product = $event->product;

        activity('admin')
            ->causedBy($admin)
            ->performedOn($product)
            ->withProperties([
                'admin' => $admin->username,
                'product_id' => $product->id,
                'actual_name' => $product->name,
                'actual_description' => $product->description,
                'actual_price' => $product->price,
            ])
        ->log("Admin has changed product's data.");
    }
}
