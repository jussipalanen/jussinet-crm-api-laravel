<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $name;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->name = $this->findUsername();
        $this->middleware('guest')->except('logout');
    }


    public function index()
    {
        return view('pages.login');
    }

    public function findUsername()
    {
        $login = request()->input('login');
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        request()->merge([$fieldType => $login]);
        return $fieldType;
    }

    /**
     * Get username property.
     *
     * @return string
     */
    public function username()
    {
        return $this->name;
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->get('login');
        $user = User::whereEmail($login)->orWhere('name', $login)->first();
        if (Auth::attempt([
            'name' => $user->name ?? null,
            'password' => $request->password
        ]) || Auth::attempt([
            'email' => $user->email ?? null,
            'password' => $request->password
        ])) {
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
