<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function profile()
    {
        return view('pages.profile.view');
    }

    public function profileEdit()
    {
        return view('pages.profile.edit');
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
