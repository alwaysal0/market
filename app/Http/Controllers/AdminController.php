<?php

namespace App\Http\Controllers;

use App\Http\Requests\actionsAdmin\AdminReportReplyRequest;
use App\Http\Requests\actionsAdmin\AdminSearchUserRequest;
use App\Http\Requests\actionsAdmin\AdminUpdateUserRequest;
use App\Http\Requests\actionsUser\EditProductRequest;
use App\Models\Product;
use App\Models\Report;
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
            'user' => $request->user(),
            'search_user' => session('search_user') ?? null,
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
            'user' => $request->user(),
            'search_user' => $user,
        ])->withInput();
    }

    public function updateUser(AdminUpdateUserRequest $request, User $user) {
        $search_user = $user;
        $validated_data = $request->validated();
        $admin = $request->user();

        if ($search_user->username !== $validated_data['username'])
            $this->adminService->changeUsername($validated_data, $admin, $search_user);

        if($search_user->email !== $validated_data['email'])
            $this->adminService->changeEmail($validated_data, $admin, $search_user);

        if (isset($validated_data['password']))
            $this->adminService->changePassword($validated_data, $admin, $search_user);

        $search_user->refresh();
        $products = $search_user->products;
        $logs = $search_user->logs;

        return back()->with([
            'success' => 'You have successfully updated users data.',
            'products' => $products,
            'logs' => $logs,
            'user' => $admin,
            'search_user' => $search_user,
        ]);
    }

    public function showProduct(Product $product) {
        return view('product')->with($this->productService->getProductViewData($product, true));
    }

    public function editProduct(EditProductRequest $request, Product $product) {
        $validated_data = $request->validated();

        $user = $request->user();
        $this->adminService->updateProduct($validated_data, $user, $product);

        return redirect()->back()->with('success', 'You have successfully updated product data.');
    }

    public function deleteProduct(Request $request, Product $product) {
        $user = $request->user();

        $this->adminService->deleteProduct($user, $product);

        return redirect()->back()->with('success', 'You have successfully deleted product data.');
    }

    public function showReports(Request $request, String $status) {
        if ($status != 'closed' && $status != 'opened') {
            return redirect()->back()->with('error', 'Invalid status.');
        }
        $reports = null;
        if ($status == "opened") {
            $reports = Report::where("status", 1)->orderBy("created_at", "desc")->get();
        } else if ($status == "closed") {
            $reports = Report::where("status", 0)->orderBy("created_at", "desc")->get();
        }
        $user = $request->user();

        return view('admin.reports')->with([
            'user' => $user,
            'reports' => $reports,
        ]);
    }

    public function showReport(Request $request, Report $report) {
        $user = $request->user();

        return view('admin.report')->with([
            'user' => $user,
            'report' => $report,
        ]);
    }

    public function replyReport(AdminReportReplyRequest $request, Report $report) {
        $user = $request->user();
        $validated_data = $request->validated();

        $this->adminService->replyReport($user, $report, $validated_data);

        return back()->with('success', 'You have successfully replied to report.');
    }
}
