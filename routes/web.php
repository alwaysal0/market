<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\FilterController;

use League\CommonMark\Output\RenderedContent;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Auth Routes
Route::group(['middleware' => ['web']], function() {
    Route::get('/register', [RenderController::class, 'showRegister'])->name('register');
    Route::post('/register-auth', [AuthController::class, 'register']);
    Route::get('/login', [RenderController::class, 'showLogin'])->name('login');
    Route::post('/login-auth', [AuthController::class, 'login']);
});

// Public Routes
Route::group(['middleware' => ['web']], function(){
    Route::get('/', [RenderController::class, 'showRegister'])->name('register');
    Route::get('/main', [RenderController::class, 'showMain'])->name('MainPage');
    Route::get('/products', [RenderController::class , 'showProducts'])->name('products');
    Route::get('/products/filter/{currentFilter}', [RenderController::class, 'showProductsFilter']);
    Route::get('/support', [RenderController::class, 'showSupportPage'])->name('support');
    Route::get('/product/{id}', [RenderController::class, 'showProduct'])->name('product');
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
            Route::post('email', [UserController::class, 'updateEmail'])->name('email.update');
            Route::post('username', [UserController::class, 'updateUsername'])->name('username.update');
        });

        Route::prefix('your-products')->group(function() {
            Route::get('/', [RenderController::class, 'showYourProducts'])->name('profile.your-products');
            Route::post('filter', [UserController::class, 'filterYourProducts'])->name('profile.your-products.filter');
            Route::post('add-product', [GoodController::class, 'upload'])->name('profile.your-products.add-product');
        });
        Route::post('/support', [UserController::class, 'sendFeedback'])->name('support.send');
        Route::post('/write-review/{id}', [UserController::class, 'sendReview'])->name('review');
    });

    Route::post('/user-confirmation', [UserController::class, 'sendUserConfirmation']);
    Route::get('/user-confirmation/{token}', [RenderController::class, 'showUserConfirmation'])->name('userConfirmation');
    Route::post('/user-confirmation/{token}', [UserController::class, 'confirmUser'])->name('userConfirmation');
});

require __DIR__ . '/profile.php';
