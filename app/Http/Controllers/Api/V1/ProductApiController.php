<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Storage;

class ProductApiController extends Controller
{
    /**
     * List all of the products
     * 
     * This queries all of the products from the table.
     * @example location description
     */
    public function index():Collection
    {

        /**
         *  @response ProductResource
         *  @body []
         *  @example {"lat": 50.450001, "long": 30.523333}
         */
        $resources =  Product::all()->map(function (Product $product) {
            // Get the full url of the feature image
            $product->featured_image = url('/') . Storage::url('app/' . $product->featured_image);
            return $product;
        })->transform(function ($product) {
            # Show only the specific fields
            return $product->only([
                'id',
                'name',
                'description',
                'product_category',
                'featured_image',
                'regular_price',
                'sale_price',
                'weight',
                'show'
            ]);
        });

        return $resources;
    }

    /**
     * Test API.
     */
    public function test(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        /**
         * A user resource.
         * 
         * @status 201
         * @body Product
         */
        return Product::create($request->only(['name']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
