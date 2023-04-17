<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Show all products in the database
     */
    public function index() {
        $products = Product::all();
        return Inertia::render('Product/HomeView', [
            'products' => $products,
        ]);
    }

    /**
     * Show create product form
     */
    public function create() {
        return Inertia::render('Product/CreateView');
    }
}
