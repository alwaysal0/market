<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Report;
use App\Models\Response;
use App\Services\FilterProductsService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RenderController extends Controller

{
    private $filterProducts;
    private $productService;
    private $user;
    public function __construct(FilterProductsService $filterProducts, ProductService $productService) {
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

    public function showProductsFilter(Request $request, $currentFilter) {
        $user = $request->user();
        $page = $request->get('page', 1);
        $view_data = $this->filterProducts->mainFilterProducts($page, $user, $currentFilter);

        return view('products')->with($view_data);
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

    public function showYourReports(Request $request) {
        $user = $request->user();
        $reports = $user->reports;
        return view('profile')->with([
            'current_page' => 'your-reports',
            'user' => $user,
            'reports' => $reports,
        ]);
    }

    public function showReport(Request $request, Report $report) {
        $user = $request->user();
        $response = $report->response;

        return view('modules.report')->with([
            'user' => $user,
            'report' => $report,
            'response' => $response,
        ]);
    }

}
