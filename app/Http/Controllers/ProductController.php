<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;

use App\Http\Requests\UploadProductRequest;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
    ){
    }

    public function upload(UploadProductRequest $request) {
        $validated_data = $request->validated();
        $user = $request->user();
        $this->productService->upload($validated_data, $user);

        return redirect()->route('profile.edit-profile')->with('success', 'Your product was successfully listed.');
    }

    public function delete(Request $request, int $id) {
        $user = $request->user();
        $product = Product::findOrFail($id);

        if ($product->user_id !==$user->id) {
            return back()->with('error', 'You are not allowed to delete this product.');
        }

        $product->delete();
        return back()->with('success', 'The product was successfully deleted.');
    }
}
