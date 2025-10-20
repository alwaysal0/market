<?php

namespace App\Http\Controllers;

use App\Http\Requests\actionsAdmin\AdminSearchUserRequest;
use App\Http\Requests\actionsAdmin\AdminUpdateUserRequest;
use App\Http\Requests\actionsUser\EditProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Services\AdminService;
use App\Services\ProductService;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct(
        private AdminService $adminService,
        private ProductService $productService
    ){
    }

    public function showAdminPanel(Request $request) {
        return view('admin.admin-panel')->with([
            'success' => 'Welcome to Admin Panel.',
            'products' => session('products') ?? collect(),
            'logs' => session('logs') ?? collect(),
            'user' => session('user') ?? null,
        ]);
    }

    public function searchUser(AdminSearchUserRequest $request) {
        $validated_data = $request->validated();

        $user = User::where('username', $validated_data['username'])->first();
        if (!$user) {
            return back()->with('error', "The user doesn't exist.")->withInput();
        }

        $products = $user->products;
        $logs = $user->logs;

        return redirect()->route('admin-panel')->with([
            'products' => $products,
            'logs' => $logs,
            'user' => $user,
        ])->withInput();
    }

    public function updateUser(AdminUpdateUserRequest $request, $id) {
        $validated_data = $request->validated();

        $user = $request->user();
        $user_to_change = User::find($id);

        if ($user_to_change->username !== $validated_data['username'])
            $this->adminService->changeUsername($validated_data, $user, $user_to_change);

        if($user_to_change->email !== $validated_data['email'])
            $this->adminService->changeEmail($validated_data, $user, $user_to_change);

        if (isset($validated_data['password']))
            $this->adminService->changePassword($validated_data, $user, $user_to_change);

        $user_to_change->refresh();
        $products = $user->products;
        $logs = $user->logs;

        return back()->with([
            'success' => 'You have successfully updated users data.',
            'products' => $products,
            'logs' => $logs,
            'user' => $user_to_change,
            ]);
    }

    public function showProduct(int $id) {
        return view('product')->with($this->productService->getProductViewData($id, true));
    }

    public function editProduct(EditProductRequest $request, int $id) {
        $validated_data = $request->validated();
        $product = Product::find($id);

        $user = $request->user();
        $this->adminService->updateProduct($validated_data, $user, $product);

        return redirect()->back()->with('success', 'You have successfully updated product data.');
    }

    public function deleteProduct(Request $request, int $id) {
        $user = $request->user();
        $product = Product::find($id);

        $this->adminService->deleteProduct($user, $product);

        return redirect()->back()->with('success', 'You have successfully deleted product data.');
    }
}
