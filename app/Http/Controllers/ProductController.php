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
        return Inertia::render('ProductView', [
            'products' => $products,
        ]);
    }
}
