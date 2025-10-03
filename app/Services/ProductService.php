<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Models\Filter;
use App\Models\Product;

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
}
