<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/add', [ProductController::class, 'create'])->name('product.create');
    Route::post('/', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/{product}', [ProductController::class, 'trash'])->name('product.trash');
    Route::get('/trash', [ProductController::class, 'trashed'])->name('product.trashed');
    Route::post('/restore/{product}', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/trash/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});
