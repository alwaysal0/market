<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Filter;

class FilterProducts {
    public function filter ($request) {
        $current_user = Auth::user();
        $query_product = Product::where('user_id', $current_user->id);
        $query_filter = Filter::where('user_id', $current_user->id);
        $products = match($request->select_filter) {
            'asc' => $query_product->orderBy('created_at', 'asc')->get(),
            'desc' => $query_product->orderBy('created_at', 'desc')->get(),
            'technique' => $query_product->whereIn('id', $query_filter->where('filter_name', 'technique')->pluck('product_id'))
            ->get(),
            'rofl' => $query_product->whereIn(
            'id', $query_filter->where('filter_name', 'rofl')->pluck('product_id'))
            ->get(),
            default => $query_product->get(),
        };
        return $products;
    }

    public function mainFilterProducts ($filterName) {
        $products_id = Filter::where('filter_name', $filterName)->pluck('product_id');
        $products = Product::whereIn('id', $products_id)->get();

        return $products;
    }   
}
