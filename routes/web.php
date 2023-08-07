<?php

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


Route::get('/', function () {
    return view('pages.index');
});


Route::get('/docs', function () {
    return view('pages.docs');
});


Route::get('/about', function () {
    return view('pages.aboutme');
});


Route::get('/donate', function () {
    return view('pages.donate');
});
