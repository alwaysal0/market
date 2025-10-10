<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RenderController;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'showAdminPanel'])->name('admin-panel');
Route::post('/search-user', [AdminController::class, 'searchUser'])->name('admin.searchUser');

Route::put('/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

Route::group(['prefix' => '/product'], function () {
    Route::put('edit/{id}', [AdminController::class, 'editProduct'])->name('admin.editProduct');
    Route::get('show/{id}', [AdminController::class, 'showProduct'])->name('admin.showProduct');
    Route::delete('delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');
});
