<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('HomeView');
    })->name('dashboard');
    
    Route::get('/tables', function () {
        return Inertia::render('TablesView');
    })->name('tables');

    Route::get('/forms', function () {
        return Inertia::render('FormsView');
    })->name('forms');

    Route::get('/ui', function () {
        return Inertia::render('UiView');
    })->name('ui');

    Route::get('/responsive', function () {
        return Inertia::render('ResponsiveView');
    })->name('responsive');

    Route::get('/', function () {
        return Inertia::render('StyleView');
    })->name('styles');

    Route::get('/profile', function () {
        return Inertia::render('ProfileView');
    })->name('profile');

    Route::get('/error', function () {
        return Inertia::render('ErrorView');
    })->name('error');
});