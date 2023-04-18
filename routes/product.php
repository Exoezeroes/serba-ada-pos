<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
});
