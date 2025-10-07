<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RenderController;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'showAdminPanel'])->name('admin-panel');
Route::post('/search-user', [AdminController::class, 'searchUser'])->name('admin.searchUser');
Route::put('/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');