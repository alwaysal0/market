<?php

namespace App\Listeners\Product;

use App\Events\Product\ProductCreated;

class LogProductCreation
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
        $current_product = $event->product;
        $user = $event->user;
        activity('product')
            ->causedBy($user)
            ->performedOn($current_product)
            ->withProperties([
                'username' => $user->username,
                'email' => $user->email,
                'product_name' => $current_product->name,
                'product_description' => $current_product->description,
                'product_price' => $current_product->price,
                'product_img_url' => $current_product->image_url,
            ])
        ->log('The user has successfully listed new product.');
    }
}
