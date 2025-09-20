<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Filter;

use App\Providers\FilterProducts;

class RenderController extends Controller

{
    private $filterProducts;
    private $user;
    public function __construct(FilterProducts $filterProducts) {
        $this->filterProducts = $filterProducts;
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

    public function showProducts() {
        $filters = Filter::distinct()->pluck('filter_name');
        $products = Product::all();

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

    public function test() {
        // $user = Auth::user();
        // return view('auth.user-confirmation')->with([
        //     'user' => $user,
        //     'id' => 2222,
        // ]);
        return view('auth.expired-page');
    }
}
