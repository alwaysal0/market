<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Product;
use App\Models\Admin;
use App\Models\Filter;
use App\Models\Log;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    public function showAdminPanel() {

        return view('admin.admin-panel')->with([
            'success' => 'Welcome to Admin Panel.',
            'products' => collect(),
            'logs' => collect(),
        ]);
    }

    public function searchUser(Request $request) {
        $request->validate([
            'username' => 'required|string|max:100',
        ]);

        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return back()->with('error', "The user doesn't exist.");
        }

        $products = $user->products;
        $products_coll = collect();
        if ($products->isNotEmpty()) {
            $products_coll = $products;
        }

        $logs = Log::where('causer_id', $user->id)->get();

        return view('admin.admin-panel')->with([
            'products' => $products_coll,
            'logs' => $logs,
        ]);
    }
    
}
