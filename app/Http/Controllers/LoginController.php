<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login');
    }

    protected function username()
    {
        $field = (filter_var(request()->email, FILTER_VALIDATE_EMAIL) || !request()->email) ? 'email' : 'username';
        request()->merge([$field => request()->email]);
        return $field;
    }


    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->withSucces('Signed in');
        }
        return redirect()->back()->withErrors('The login details are not valid. Please try again.');
    }

    /**
     * Do logout
     *
     * @return void
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
        
        return Redirect('login');
    }
}
