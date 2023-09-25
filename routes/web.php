<?php

// use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', [HomeController::class, 'index'])->middleware(Authenticate::class);
Route::get('/docs', [HomeController::class, 'docs'])->middleware(Authenticate::class);
Route::get('/about', [HomeController::class, 'about'])->middleware(Authenticate::class);
Route::get('/donate', [HomeController::class, 'donate'])->middleware(Authenticate::class);

// Products
Route::get('/products', [ProductController::class, 'index'])->middleware(Authenticate::class);
Route::get('/products/add', [ProductController::class, 'create'])->middleware(Authenticate::class);
Route::post('/products/add', [ProductController::class, 'store'])->middleware(Authenticate::class);
Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->middleware(Authenticate::class);
Route::post('/products/edit/{id}', [ProductController::class, 'update'])->middleware(Authenticate::class);
Route::resource('products', ProductController::class)->middleware(Authenticate::class);

// Product categories
Route::get('/product_cats', [ProductCategoryController::class, 'index'])->middleware(Authenticate::class);
Route::get('/product_cats/add', [ProductCategoryController::class, 'create'])->middleware(Authenticate::class);
Route::post('/product_cats/add', [ProductCategoryController::class, 'store'])->middleware(Authenticate::class);
Route::get('/product_cats/edit/{id}', [ProductCategoryController::class, 'edit'])->middleware(Authenticate::class);
Route::post('/product_cats/edit/{id}', [ProductCategoryController::class, 'update'])->middleware(Authenticate::class);
Route::resource('product_cats', ProductCategoryController::class)->middleware(Authenticate::class);

// Profile/user
Route::get('/profile', [ProfileController::class, 'index'])->middleware(Authenticate::class);
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware(Authenticate::class);
Route::post('/profile/edit', [ProfileController::class, 'update'])->middleware(Authenticate::class);
Route::get('/profile/change_password', [ProfileController::class, 'get_change_password'])->middleware(Authenticate::class);
Route::post('/profile/change_password', [ProfileController::class, 'post_change_password'])->middleware(Authenticate::class);

// Login
Route::get('/login', [LoginController::class, 'index'])->name('auth.getlogin');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.dologin');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.dologout');

// Posts
Route::get('/posts', [PostController::class, 'index'])->middleware(Authenticate::class);
Route::get('/posts/add', [PostController::class, 'create'])->middleware(Authenticate::class);
Route::post('/posts/add', [PostController::class, 'store'])->middleware(Authenticate::class);
Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->middleware(Authenticate::class);
Route::post('/posts/edit/{id}', [PostController::class, 'update'])->middleware(Authenticate::class);
Route::resource('posts', PostController::class)->middleware(Authenticate::class);