<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{

    private $validation = [
        'name' => ['required', 'max:255']
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_categories = ProductCategory::paginate(10);
        return view('pages.product_cats.list', ['product_categories' => $product_categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.product_cats.form', [
            'mode' => 'create',
            'url' => url('/product_cats/add'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Check validation, or return the error messages
        $request->validate($this->validation);

        ProductCategory::create([
            'name' => $request->name ?: 'null',
            'description' => $request->description ?: null,
        ]);

        return redirect('/product_cats/add')->with([
            'success' => 'The product category has been added successfully into the database.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $product_category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product_category = ProductCategory::whereId($id)->firstOrFail();
        return view('pages.product_cats.form', [
            'product_category' => $product_category, 
            'mode' => 'edit',
            'url' => url('/product_cats/edit', ['id' => $product_category->id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        # Check validation, or return the error messages
        $request->validate($this->validation);

        ProductCategory::whereId($id)->update([
            'name' => $request->name ?: 'null',
            'description' => $request->description ?: null,
        ]);

        $url = url('/product_cats/edit', ['id' => $request->id]);
        return redirect($url)->with([
            'success' => 'The product category has been updated successfully into the database.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $product_category)
    {
        $product_category->delete();
        return redirect('/product_cats')->withSuccess(__('The product category deleted successfully.'));
    }
}
