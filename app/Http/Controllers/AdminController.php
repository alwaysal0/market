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

use App\Services\AdminService;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    private $adminService;

    public function __construct(AdminService $adminService) {
        $this->adminService = $adminService;
    }

    public function showAdminPanel() {
        if (session()->has('products'))
            $products = session('products');

        if (session()->has('logs'))
            $logs = session('logs');

        if (session()->has('user'))
            $user = session('user');

        return view('admin.admin-panel')->with([
            'success' => 'Welcome to Admin Panel.',
            'products' => $products ?? collect(),
            'logs' => $logs ?? collect(),
            'user' => $user ?? null,
        ]);
    }

    public function searchUser(Request $request) {
        $request->validate([
            'username' => 'required|string|max:100',
        ]);

        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return back()->with('error', "The user doesn't exist.")->withInput();
        }

        $products = $user->products;
        $products_coll = collect();
        if ($products->isNotEmpty()) {
            $products_coll = $products;
        }

        $logs = Log::where('causer_id', $user->id)->get();

        return redirect()->route('admin-panel')->with([
            'products' => $products_coll,
            'logs' => $logs,
            'user' => $user,
        ])->withInput();
    }

    public function updateUser(Request $request, $id) {
        $request->validate([
            'username' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'nullable|min:6|regex:/^(?=.*[0-9])(?=.*[\W_]).+$/',
        ]);

        $user = User::find($id);
        if ($user->username !== $request->username)
            $this->adminService->changeUsername($request, $id);

        if($user->email !== $request->email)
            $this->adminService->changeEmail($request, $id);

        if (isset($request->password))
            $this->adminService->changePassword($request, $id);

        return back()->with('success', 'You have successfully updated users data.');
    }
    
}
