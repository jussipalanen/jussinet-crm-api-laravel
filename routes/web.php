<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

// Customers
Route::get('/customers', [CustomerController::class, 'index'])->middleware(Authenticate::class);
Route::get('/customers/add', [ProductController::class, 'create'])->middleware(Authenticate::class);
Route::get('/customers/edit', [ProductController::class, 'edit'])->middleware(Authenticate::class);

// Products
Route::get('/products', [ProductController::class, 'index'])->middleware(Authenticate::class);
Route::get('/products/add', [ProductController::class, 'create'])->middleware(Authenticate::class);
Route::get('/products/edit', [ProductController::class, 'edit'])->middleware(Authenticate::class);

// Profile/user
Route::get('/profile', [ProfileController::class, 'index'])->middleware(Authenticate::class);
Route::get('/profile/edit', [ProfileController::class, 'edit'])->middleware(Authenticate::class);

// Login
Route::get('/login', [LoginController::class, 'index'])->name('auth.getlogin');
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth.dologin');
Route::get('/logout', [LoginController::class, 'logout'])->name('auth.dologout');