<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Show all products in the database
     */
    public function index()
    {
        $products = Product::query()->get();
        return Inertia::render('Product/HomeView', [
            'products' => $products,
        ]);
    }

    /**
     * Show all soft deleted products
     */
    public function trash()
    {
        $products = Product::onlyTrashed()->get();

        return Inertia::render('Product/TrashView', [
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
        Product::query()
            ->create($request->validated());

        return to_route('product.index')->with([
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

    /**
     * Update an edited product
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        Product::query()
            ->where('id', $product->id)
            ->update($request->validated());

        return to_route('product.index')->with([
            'type' => 'success',
            'message' => 'Product edited successfully'
        ]);
    }

    /**
     * Delete a product
     */
    public function destroy(Product $product)
    {
        Product::query()
            ->find($product->id)
            ->delete();

        return to_route('product.index')->with([
            'type' => 'warning',
            'message' => 'Product "' . $product->title . '" has been trashed'
        ]);
    }

    /**
     * Restore a product
     */
    public function restore($id)
    {
        Product::onlyTrashed()
            ->find($id)
            ->restore();

        return to_route('product.trash')->with([
            'type' => 'success',
            'message' => 'Product restored successfully'
        ]);
    }
}
