<?php

use App\Http\Controllers\AuthController;
use App\Models\Post;
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

Route::group([
    'prefix' => 'v1',
    'namespace' => 'App\Http\Controllers\Api\V1',
    'middleware' => 'auth:sanctum'
    ]
    , function () {
    Route::apiResource('products', 'ProductApiController'); # Product resource
    Route::apiResource('posts', 'PostApiController'); # Post resource
});