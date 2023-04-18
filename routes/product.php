<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});
