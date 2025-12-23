<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    /*
     * Adds new product data to a nested "cart" array in the session.
     * Redirects the user back to the CartPage.
     */
    public function add(Product $product) {
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id_product' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image_url,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /*
     * Decrements the product quantity in the cart array.
     * Redirects the user back to the CartPage.
     */
    public function decrease(String $id_product) {
        $id_product = (int) $id_product;
        $product = Product::findOrFail($id_product);
        if ($product) {
            $cart = session()->get('cart');
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']--;
                if ($cart[$product->id]['quantity'] <= 0) {
                    unset($cart[$product->id]);
                }
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'The product quantity has been decreased.');
    }

    /*
     * Increments the product quantity in the cart array.
     * Redirects the user back to the CartPage.
     */
    public function increase(String $id_product) {
        $id_product = (int) $id_product;
        $product = Product::findOrFail($id_product);
        if ($product) {
            $cart = session()->get('cart');
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']++;
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'The product quantity has been increased.');
    }
}
