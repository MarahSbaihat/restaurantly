<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;
use Illuminate\Support\Facades\Route;

// dashboard routes

Route::middleware(['auth' , 'isAdmin'])->prefix('admin')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class , 'index'])->name('index');
    // category routes
    Route::resource('categories' , CategoryController::class);
    // product routes
    Route::resource('products' , ProductController::class);
});

?>
