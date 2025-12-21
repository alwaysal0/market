<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function add(Request $request, Product $product) {
        $cart = session()->get('cart');
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image_url,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function remove(Request $request, Product $product) {
        if ($product->id) {
            $cart = session()->get('cart');
            if (isset($cart[$product->id])) {
                $cart[$product->id]['quantity']--;
                if ($cart[$product->id]['quantity'] <= 0) {
                    unset($cart[$product->id]);
                }
                session()->put('cart', $cart);
                session()->flash('success', 'The product has been removed.');
            }
        }
    }
}
