<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Http;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Password;
use Str;
use View;

class ProfileController extends Controller
{

    private $validation = [
        'firstname' => ['required', 'max:255'],
        'lastname' => ['required', 'max:255'],
        'phone' => ['regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
        'person_image' => ['nullable', 'max:2000', 'mimes:jpeg,jpg,png,gif'],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.view', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        $response = Http::get('https://data.stat.fi/api/classifications/v2/classifications/valtio_2_20120101/classificationItems?content=data&meta=max&lang=fi&format=json');
        $data = json_decode( $response->body(), true );

        $countries = new Collection();
        foreach ($data as $item) {
            $countries[] = collect(
            [
                'key' => $item['code'],
                'value' => reset( $item['classificationItemNames'])['name'],
            ]);
        }
        return view('pages.profile.edit', [
            'user' => $user,
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function get_change_password(User $user)
    {
        $user = Auth::user();
        return View::make('pages.profile.change_password', ['user' => $user]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function post_change_password(Request $request)
    {
        $request->validate([
            'current_password' => ['required:true'],
            'password' => ['required:true', 'min:6', 'max:30'],
            'repassword' => ['required:true', 'min:6', 'max:30', 'same:password', 'required_with:password'],
        ]);


        $user = Auth::user();
        $hasher = app('hash');
        if( !$hasher->check($request->current_password, $user->password) )
        {
            return redirect()->back()->withErrors([
                'error' => 'Your current password is wrong.',
            ]);
        }
    

        $user->forceFill([
            'password' => Hash::make($request->password)
        ])->setRememberToken(Str::random(60));
        if( $user->save() ) 
        {
            return redirect('/profile/change_password')->with([
                'success' => 'Password has been updated successfully.',
            ]);
        }
        
        return redirect()->back()->withErrors([
            'error' => 'Passwords cannot be updated.',
        ]);
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        # Check validation, or return the error messages
        $request->validate($this->validation);

        # Move the featured image to public resource directory
        $person_image = isset( $request->uploaded_person_image ) ? $request->uploaded_person_image : null;
        if( $request->file('person_image') )
        {
            $person_image = $request->file('person_image')->storePublicly('profiles/user_' . $user->id . '/') ?: null;
        }

        $user->update([
            'firstname' => $request->firstname ?: null,
            'lastname' => $request->lastname ?: null,
            'address' => $request->address ?: null,
            'city' => $request->city ?: null,
            'country' => $request->country ?: null,
            'phone' => $request->phone ?: null,
            'person_image' => $person_image ?: null,
        ]);

        $url = url('/profile/edit');
        return redirect($url)->with([
            'success' => 'Profile has been updated successfully into the database.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
