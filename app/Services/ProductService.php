<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Models\Filter;
use App\Models\Product;
use App\Models\Review;

class ProductService {

    private $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    public function sameProducts($id) {
        $product = Product::find($id);
        $filterNames = $product->filters->pluck('filter_name');

        $same_products_id = Filter::whereIn('filter_name', $filterNames)
        ->where('product_id', '!=', $id)
        ->distinct()
        ->pluck('product_id');
        
        $same_products = Product::whereIn('id', $same_products_id)->limit(5)->get();

        return $same_products;
    }

    public function getProductViewData($id, $isAdmin = false) {
        $filters = Filter::where('product_id', $id)->get();
        $same_products = collect();

        if($filters) {
            $same_products = $this->sameProducts($id);
        }

        $reviews = Review::where('product_id', $id)->get();

        return [
            'product' => Product::find($id),
            'same_products' => $same_products,
            'filters' => $filters,
            'reviews' => $reviews,
            'user' => $this->user ?? null,
            'admin' => $isAdmin,
        ];
    }
}
