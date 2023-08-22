<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $validation = [
        'name' => ['required', 'max:255'],
        'description' => ['required'],
        'regular_price' => ['required'],
        'featured_image' => ['nullable', 'max:2000', 'mimes:jpeg,jpg,png,gif'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $limit = isset($_GET['limit']) && is_numeric($_GET['limit']) ? intval( $_GET['limit'] ) : 10;
        $products = Product::paginate($limit);
        if( isset($_GET['s']) && $_GET['s'] )
        {
            $search = trim($_GET['s']);
            $products = Product::where('name', 'LIKE', '%' . $search . '%')->paginate($limit);
        }
        return view('pages.products.list', [
            'products' => $products,
            'limit' => $limit,
            's' => isset($_GET['s']) ? trim(($_GET['s'])) : '',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.form', [
            'form_title' => 'Add product',
            'mode' => 'create',
            'product_categories' => ProductCategory::all(),
            'url' => url('/products/add'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        # Check validation, or return the error messages
        $request->validate($this->validation);

        # Move the featured image to public resource directory
        $featured_image = null;
        if( $request->file('featured_image') )
        {
            $featured_image = $request->file('featured_image')->storePublicly('products') ?: null;
        }

        Product::create([
            'name' => $request->name ?: 'null',
            'description' => $request->description ?: null,
            'product_category_id' => $request->product_category_id ?: null,
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = Product::whereId($id)->firstOrFail();
        return view('pages.products.form', [
            'form_title' => 'Edit product',
            'product' => $product, 
            'mode' => 'edit',
            'product_categories' => ProductCategory::all(),
            'url' => url('/products/edit', ['id' => $product->id]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        # Check validation, or return the error messages
        $request->validate($this->validation);

        # Move the featured image to public resource directory
        $featured_image = isset( $request->uploaded_featured_image ) ? $request->uploaded_featured_image : null;
        if( $request->file('featured_image') )
        {
            $featured_image = $request->file('featured_image')->storePublicly('products') ?: null;
        }

        Product::whereId($id)->update([
            'name' => $request->name ?: 'null',
            'description' => $request->description ?: null,
            'product_category_id' => $request->product_category_id ?: null,
            'regular_price' => $request->regular_price ?: 0,
            'sale_price' => $request->sale_price ?: null,
            'featured_image' => $featured_image ?: null,
            'weight' => $request->weight ?: null,
            'show' => (bool) $request->show !== false ? true : false,
        ]);

        $url = url('/products/edit', ['id' => $request->id]);
        return redirect($url)->with([
            'success' => 'Product has been updated successfully into the database.',
        ]);
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
