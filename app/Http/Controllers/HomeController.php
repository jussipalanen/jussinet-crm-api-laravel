<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function customers()
    {
        return view('pages.customers');
    }

    public function products()
    {
        return view('pages.products');
    }

    public function about()
    {
        return view('pages.aboutme');
    }

    public function docs()
    {
        return view('pages.docs');
    }

    public function donate()
    {
        return view('pages.donate');
    }
}
