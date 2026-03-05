<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
     */
    private function decrease($cart, $product)
    {
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']--;
            if ($cart[$product->id]['quantity'] <= 0) {
                unset($cart[$product->id]);
            }
        }

        return $cart;
    }

    /*
     * Increments the product quantity in the cart array.
     */
    private function increase($cart, $product)
    {
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        }

        return $cart;
    }

    public function update(Request $request)
    {
        $id_product = $request->id;
        $action = $request->action;

        $product = Product::findOrFail($id_product);
        if ($product) {
            $cart = session()->get('cart');
            switch ($action) {
                case "increase":
                    $cart = $this->increase($cart, $product);
                    break;
                case "decrease":
                    $cart = $this->decrease($cart, $product);
            }

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'newQuantity' => $cart[$id_product]['quantity'] ?? null,
                'message' => 'Quantity updated successfully.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Product not found.'
        ]);
    }
}
