<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RenderController;
use App\Http\Controllers\AdminController;

Route::get('/', [AdminController::class, 'showAdminPanel'])->name('admin-panel');
Route::post('/search-user', [AdminController::class, 'searchUser'])->name('admin.searchUser');

Route::put('/update-user/{user}', [AdminController::class, 'updateUser'])->name('admin.updateUser');

Route::group(['prefix' => '/product'], function () {
    Route::put('edit/{product}', [AdminController::class, 'editProduct'])->name('admin.editProduct');
    Route::get('show/{product}', [AdminController::class, 'showProduct'])->name('admin.showProduct');
    Route::delete('delete/{product}', [AdminController::class, 'deleteProduct'])->name('admin.deleteProduct');
});

Route::group(['prefix' => '/reports'], function () {
    Route::get('/{status}', [AdminController::class, 'showReports'])->name('admin.showReports');
    Route::get('/show/{report}', [AdminController::class, 'showReport'])->name('admin.showReport');
});
