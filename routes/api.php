<?php

use App\Http\Controllers\AuthController;
use App\Models\Product;
use Illuminate\Http\Request;
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
