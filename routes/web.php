<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\AuthController;
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
    Route::get('/products', [RenderController::class , 'showProducts']);
    Route::get('/products/filter/{currentFilter}', [RenderController::class, 'showProductsFilter']);
});

// Authorized Routes
Route::group(['middleware' => ['web', 'auth']],function() {
    Route::get('/profile', [RenderController::class, 'showProfile']);
    Route::get('/profile/{currentPage}', [ProfileController::class, 'showProfile']);

    Route::post('/profile/add-good/{currentAction}', [GoodController::class, 'upload']);
    Route::post('/profile/edit-profile/change-password/{action}', [EmailController::class, 'checkAction']);
    Route::post('/profile/edit-profile/{action}', [ProfileController::class, 'editProfile']);
    Route::post('/profile/your-products/filter', [ProfileController::class, 'filterProducts']);

    Route::post('/user-confirmation', [EmailController::class, 'sendUserConfirmation']);
    Route::get('/user-confirmation/{token}', [RenderController::class, 'showUserConfirmation'])->name('userConfirmation');
    Route::post('/user-confirmation/{token}', [AuthController::class, 'confirmUser'])->name('userConfirmation');
});
