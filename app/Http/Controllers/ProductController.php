<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Show all products in the database
     */
    public function index()
    {
        $products = Product::all();
        return Inertia::render('Product/HomeView', [
            'products' => $products,
        ]);
    }

    /**
     * Show create product form
     */
    public function create()
    {
        return Inertia::render('Product/CreateView');
    }

    /**
     * Store a created product
     */
    public function store(ProductStoreRequest $request)
    {
        $product = $request->validated();
        
        Product::create($product);

        return to_route('product.index')
            ->with([
                'type' => 'success',
                'message' => 'Product added successfully'
            ]);
    }

    /**
     * Show edit product form
     */
    public function edit(Product $product)
    {
        return Inertia::render('Product/EditView', [
            'product' => $product
        ]);
    }
}
