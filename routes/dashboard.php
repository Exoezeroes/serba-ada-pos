<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])
    ->prefix('/dashboard')
    ->group(function () {
        Route::get('/', function () {
            return Inertia::render('HomeView');
        })->name('dashboard');

        Route::get('/products', [ProductController::class, 'index'])
            ->name('product.index');

        Route::get('/tables', function () {
            return Inertia::render('TablesView');
        })->name('tables');

        Route::get('/forms', function () {
            return Inertia::render('FormsView');
        })->name('forms');

        Route::get('/ui', function () {
            return Inertia::render('UiView');
        })->name('ui');

        Route::get('/profile', function () {
            return Inertia::render('ProfileView');
        })->name('profile');
    });
