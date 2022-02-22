<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $countries = Countries::all();
        return view('auth.register', compact('countries'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string','min:3', 'max:255'],
            'last_name' => ['required', 'string','min:3', 'max:255'],
            'phone' => ['required', 'string','min:8', 'max:255','unique:users'],
            'country' => ['required', 'string', 'max:255'],
            'country_code' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string','min:10', 'max:255'],
            'user_profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // $path = $request->user_profile_image->store('public/'.'/user_profile_images');

        $path = $request->user_profile_image->storePublicly('user_profile_images','s3');
        $path = Storage::disk('s3')->url($path);

        if($request->role == 'admin'){
            abort(403);
        }
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_profile_image' => $path,
            'phone' => $request->phone,
            'country' => $request->country,
            'country_code' => $request->country_code,
            'description' =>$request->description,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->attachRole($request->role);

        event(new Registered($user));


        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);

    }
    // public function show(User $user)
    // {
    //     return $user->load('posts');
    // }
}
