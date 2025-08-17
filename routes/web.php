<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RenderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\EmailController;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', [RenderController::class, 'showRegister'])->name('register');
Route::get('/register', [RenderController::class, 'showRegister'])->name('register');
Route::post('/register-auth', [AuthController::class, 'register']);

Route::get('/login', [RenderController::class, 'showLogin'])->name('login');
Route::post('/login-auth', [AuthController::class, 'login']);


Route::get('/main', [RenderController::class, 'showMain'])->name('MainPage');

Route::get('/profile/{currentPage}', [ProfileController::class, 'showProfile'])->middleware('auth');

Route::post('/profile/edit-profile/change-password/{action}', [EmailController::class, 'checkAction'])->middleware('auth');
Route::post('/profile/edit-profile/{action}', [ProfileController::class, 'editProfile'])->middleware('auth');



