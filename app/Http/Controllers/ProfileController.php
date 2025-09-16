<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;

use App\Providers\FilterProducts;

class ProfileController extends Controller
{
    private $filterProducts;
    public function __construct(FilterProducts $filterProducts) {
        $this->filterProducts = $filterProducts;
    }
    //
    public function showProfile ($current_page) {
        if ($current_page === 'logout') {
            Auth::logout();
            
            return redirect('/login')->with('success', 'You have successfully logged out of your account.');
        }

        $current_user = Auth::user();
        if ($current_page === 'your-products') {
            $products = Product::where('user_id', $current_user->id)->get();
            return view('profile')->with([
                'current_page'=> $current_page,
                'user' => $current_user,
                'products' => $products,
            ]);
        } else {
            return view('profile')->with([
                'current_page'=> $current_page,
                'user' => $current_user,
            ]);
        }
    }

    public function editProfile($action, Request $request) {
        $current_user = Auth::user();
        switch($action) {
            case 'username':
                User::where('id', $current_user->id)->update([
                    'username' => $request->username,
                ]);
                break;
            case 'email':
                User::find($current_user->id)->update([
                    'confirmed' => false,
                ]);
                User::where('id', $current_user->id)->update([
                    'email' => $request->email,
                ]);
                break;
        };

        return back()->with('success', 'Your ' . $action . ' has been successfully updated.');
    }

    public function filterProducts(request $request) {
        $current_user = Auth::user();
        $products = $this->filterProducts->filter($request);

        return view('profile')->with([
            'current_page' => 'your-products',
            'user' => $current_user,
            'products' => $products,
        ]);
    }
}
