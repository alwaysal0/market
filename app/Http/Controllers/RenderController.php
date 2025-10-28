<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Filter;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

use App\Services\FilterProducts;
use App\Services\ProductService;

class RenderController extends Controller

{
    private $filterProducts;
    private $productService;
    private $user;
    public function __construct(FilterProducts $filterProducts, ProductService $productService) {
        $this->filterProducts = $filterProducts;
        $this->productService = $productService;
        $this->user = Auth::user();
    }

    public function showRegister() {
        if (Auth::check()) {
            return redirect('/main');
        } else {
            return view('auth.register');
        }
    }

    public function showLogin() {
        if (Auth::check()) {
            return redirect('/main');
        } else {
            return view('auth.login');
        }
    }

    public function showUserConfirmation($token) {
        return view('user.user-confirmation')->with([
            'user' => $this->user,
            'token' => $token,
        ]);
    }

    public function showMain() {
        $products = Product::orderBy('created_at', 'desc')->limit(10)->get();
        return view('main')->with([
                'user' => $this->user,
                'products' => $products,
            ]
        );
    }

    public function showProfile() {
        return view('profile')->with([
            'current_page' => 'edit-profile',
            'user' => $this->user,
        ]);
    }

    public function showYourProducts() {
        $products = Product::where('user_id', $this->user->id)->get();
            return view('profile')->with([
                'current_page'=> 'your-products',
                'user' => $this->user,
                'products' => $products,
        ]);
    }

    public function showProducts(Request $request) {
        $page = $request->get('page', 1);
        $user = $request->user();
        $view_data = $this->productService->getProductsViewData($page, $user);


        return view('products', $view_data);
    }

    public function showProductsFilter($currentFilter) {
        $filters = Filter::distinct()->pluck('filter_name');
        $products = $this->filterProducts->mainFilterProducts($currentFilter);

        if(Auth::check()) {
            return view('products')->with([
                'products' => $products,
                'filters' => $filters,
                'user' => Auth::user(),
            ]);
        }

        return view('products')->with([
            'products' => $products,
            'filters' => $filters,
        ]);
    }

    public function showProduct(Product $product) {
        return view('product')->with($this->productService->getProductViewData($product));
    }

    public function showEditProduct(Product $product) {
        return view('product')->with($this->productService->getProductViewData($product));
    }

    public function showSupportPage() {
        return view('support')->with([
            'user' => $this->user,
        ]);
    }

}
