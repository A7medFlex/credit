<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\PostsModell;
use App\Models\User;
use App\Models\ThemeModel;
use Illuminate\Http\Request;

class wholePost extends Controller
{
    public function post($id)
    {
        $allusers = User::all();
        $post = PostsModell::where('id','like',$id)->with('images')->first();
        $user = User::where('id','like', $post->user_id)->first();
        $comments = comments::where('posts_modell_id','like', $id)->with('user')->latest()->get();
        return view('single_post',compact('user','post','comments','allusers'));
    }
    // returning users for settings page
    public function settings()
    {
        $allusers = User::all();
        $theme = ThemeModel::all();
        return view('website_settings',compact('allusers','theme'));
    }
}
