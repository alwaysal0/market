<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\Product;
use App\Models\Filter;

class FilterProductsService {
    public function filter (Request $request) : Collection
    {
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

    public function mainFilterProducts (int $page, User $user, $filterName) : array
    {
        $products_id = Filter::where('filter_name', $filterName)->pluck('product_id');
        $ttl = now()->addHour();

        $filtersCacheKey = "filtered:filter-{$filterName}:product_filters";
        $filters = Cache::tags(['filters'])->remember($filtersCacheKey, $ttl, function () {
            return Filter::distinct()->pluck('filter_name');
        });

        $productsCacheKey = "filtered:filter-{$filterName}:products.page.{$page}";
        $products = Cache::tags(['products'])->remember($productsCacheKey, $ttl, function () use ($products_id) {
            return Product::whereIn('id', $products_id)->paginate(8);
        });

        $view_data = [
            'products' => $products,
            'filters' => $filters,
        ];
        if(Auth::check()) {
            $view_data['user'] = $user;
        }

        return $view_data;
    }
}
