<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Show all products in the database
     */
    public function index() {
        return Inertia::render('ProductView');
    }
}
