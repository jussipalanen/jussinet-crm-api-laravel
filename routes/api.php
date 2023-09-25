<?php

use App\Http\Controllers\AuthController;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

# User token API
Route::get('/token', [AuthController::class, 'auth'])->name('token');
Route::post('/token', [AuthController::class, 'auth'])->name('token');

# Product API
Route::get('/products', function()
{
    return Product::all()->map(function( $product ){
        // Get the full url of the feature image
        $product->featured_image = url('/') . Storage::url( 'app/' . $product->featured_image );
        return $product;
    })->transform(function($product)
    {
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
})->middleware('auth:sanctum')->name('products');

# Product API
Route::get('/posts', function()
{
    return Post::all()->map(function( $post ){
        // Get the full url of the feature image
        $post->featured_image = url('/') . Storage::url( 'app/' . $post->featured_image );
        return $post;
    })->transform(function($post)
    {
        # Show only the specific fields
        return $post->only([
            'id', 
            'name', 
            'content',
            'featured_image',
            'show'
        ]);
    });
})->middleware('auth:sanctum')->name('products');

