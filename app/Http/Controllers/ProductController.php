<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('pages.products.list', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Check validation, or return the error messages
        $request->validate([
            'name' => ['required', 'max:255'],
            'description' => ['required'],
            'regular_price' => ['required'],
            'featured_image' => ['nullable', 'max:2000', 'mimes:jpeg,jpg,png,gif'],
        ]);

        # Move the featured image to public resource directory
        $featured_image = $request->file('featured_image')->storePublicly('products') ?: null;

        Product::create([
            'name' => $request->name ?: 'null',
            'description' => $request->description ?: null,
            'regular_price' => $request->regular_price ?: 0,
            'sale_price' => $request->sale_price ?: null,
            'featured_image' => $featured_image ?: null,
            'weight' => $request->weight ?: null,
            'show' => (bool) $request->show !== false ? true : false,
        ]);

        return redirect('/products/add')->with([
            'success' => 'Product has been added successfully into the database.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = Product::whereId($id)->firstOrFail();
        return view('pages.products.add', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products')->withSuccess(__('Product deleted successfully.'));
    }
}
