<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Image;

class EditProfile extends Controller
{
    public function index()
    {
        $allusers = User::latest()->get();
        $countries = Countries::all();
        return view('edit_profile', compact('countries','allusers'));
    }
    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);
        $user->update([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'phone'=>$request->phone,
            'country'=>$request->country,
        ]);
        if($request->has('user_profile_image')){

            Storage::disk('s3')->delete($user->user_profile_image);
            // $exists = Storage::disk('s3')->exists($request->user_profile_image);
            // dd($exists);
            $path = $request->user_profile_image->storePublicly('user_profile_images','s3');
            $path = Storage::disk('s3')->url($path);

            // Storage::delete($user->user_profile_image);
            // $path = $request->user_profile_image->store('public/'.'/user_profile_images');
            $user->update([
                'user_profile_image' => $path,
            ]);
        }
        return redirect()->back();
    }
    public function update_pass(Request $request)
    {
        $user = Auth::user();
        if($request->has('password')){
            $request->validate([
                'password' => ['required','string', 'min:8', 'confirmed']
            ]);
            $user->update([
                'password'=>Hash::make($request->password)
            ]);
        }
        return redirect()->back();
    }
}
