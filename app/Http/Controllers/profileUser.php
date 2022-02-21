<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PostsModell;
use Illuminate\Http\Request;

class profileUser extends Controller
{
    public function profile($id)
    {
        $allusers = User::all();
        $posts = PostsModell::where('user_id','like',$id)->with('images')->latest()->get();
        $user = User::where('id','like',$id)->first();;
        return view('user_profile',compact('posts','user','allusers'));
    }
}
