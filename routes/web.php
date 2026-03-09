<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

// Admin Routes
Route::prefix('admin')->middleware(['web', 'auth', 'admin'])->group(base_path('routes/admin.php'));

// Auth Routes
Route::group(['middleware' => ['web']], function() {
    Route::get('/register', [RenderController::class, 'showRegister'])->name('register');
    Route::post('/register-auth', [AuthController::class, 'register'])->name('register.auth');
    Route::get('/login', [RenderController::class, 'showLogin'])->name('login');
    Route::post('/login-auth', [AuthController::class, 'login'])->name('login.auth');
});

// Public Routes
Route::group(['middleware' => ['web']], function(){
    Route::get('/', [RenderController::class, 'showRegister'])->name('register');
    Route::get('/main', [RenderController::class, 'showMain'])->name('MainPage');
    Route::get('/products', [RenderController::class , 'showProducts'])->name('products');
//    Route::get('/products/{currentFilter}', [RenderController::class, 'showProductsFilter'])->name('products');
    Route::get('/support', [RenderController::class, 'showSupportPage'])->name('support');
    Route::get('/product/{product}', [RenderController::class, 'showProduct'])->name('product');
});

// Authorized Routes
Route::group(['middleware' => ['web', 'auth']],function() {
    Route::prefix('profile')->group(function() {
        Route::get('/edit-profile', [RenderController::class, 'showProfile'])->name('profile.edit-profile');
        Route::post('/logout', [UserController::class, 'logout'])->name('profile.logout');

        // Edit Profile Routes
        Route::prefix('edit-profile')->group(function() {
            Route::prefix('password')->group(function() {
                Route::post('email', [UserController::class, 'sendPasswordCode'])->name('password.email');
                Route::post('code', [UserController::class, 'checkPasswordCode'])->name('password.code');
                Route::post('update', [UserController::class, 'updatePassword'])->name('password.update');
            });
            Route::post('username', [UserController::class, 'updateUsername'])->name('username.update');
            Route::post('email', [UserController::class, 'updateUsername'])->name('email.update');


        });

        // =============================================
        Route::prefix('your-products')->name('profile.your-products')->group(function() {
            Route::get('/', [RenderController::class, 'showYourProducts']);
            Route::post('/', [ProductController::class, 'upload'])->name('.add-product');

            Route::get('/{product}', [RenderController::class, 'showEditProduct'])->name('.show');
            Route::delete('/{product}', [ProductController::class, 'delete'])->name('.delete');
        });
        // =============================================

        Route::prefix('your-reports')->group(function() {
            Route::get('/', [RenderController::class, 'showYourReports'])->name('profile.your-reports');
            Route::get('/{report}', [RenderController::class, 'showReport'])->name('profile.your-reports.report');
        });
    });

    Route::prefix('cart')->name('cart')->group(function() {
        Route::get('/', [RenderController::class, 'showCart']);
        Route::post('/{product}', [CartController::class, 'add'])->name('.add');
        Route::patch('/', [CartController::class, 'update'])->name('.update');
    });

    Route::post('/support', [UserController::class, 'sendReport'])->name('support.send');
    Route::post('/write-review/{id}', [UserController::class, 'sendReview'])->name('review');

    Route::prefix('/user-confirmation')->group(function() {
        Route::post('/', [UserController::class, 'sendUserConfirmation']);
        Route::get('/{token}', [RenderController::class, 'showUserConfirmation'])->name('userConfirmation');
        Route::post('/{token}', [UserController::class, 'confirmUser'])->name('userConfirmation');
    });
});
