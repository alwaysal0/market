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
use App\Services\ProductService;

use App\Http\Requests\EditProductRequest;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    private $adminService;
    private $productService;

    public function __construct(AdminService $adminService, ProductService $productService) {
        $this->adminService = $adminService;
        $this->productService = $productService;
    }

    public function showAdminPanel() {
        if (session()->has('products'))
            $products = session('products');

        if (session()->has('logs'))
            $logs = session('logs');

        if (session()->has('user'))
            $user = session('user');

        $user = Auth::user();
        $products = $user->products;
        $logs = Log::where('causer_id', $user->id)->get();

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

    public function showProduct($id) {
        return view('product')->with($this->productService->getProductViewData($id, true));
    }

    public function editProduct(EditProductRequest $request, $id) {
        $request->validated();
        $this->adminService->updateProduct($request, $id);

        return redirect()->back()->with('success', 'You have successfully updated product data.');
    }

    public function deleteProduct($id) {
        $this->adminService->deleteProduct($id);

        return redirect()->back()->with('success', 'You have successfully deleted product data.');
    }
}
