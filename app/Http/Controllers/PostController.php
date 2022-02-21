<?php

namespace App\Http\Controllers;

use App\Models\PostsImagesModell;
use App\Models\PostsModell;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_title' => ['required', 'string','min:3', 'max:255'],
            'post_content' => ['required', 'string','min:5'],
        ]);
        $user = Auth::user();
        $post = PostsModell::create([
            'user_id'=>$user->id,
            'post_title'=>$request->post_title,
            'post_content'=>$request->post_content
        ]);
        if($request->hasFile('post_images')){
            foreach ($request->file('post_images') as $img) {
                $path = $img->store('public/'.$user->id.'/'.$post->id.'/asking_help_images');
                $images = PostsImagesModell::create([
                    'posts_modell_id'=>$post->id,
                    'post_images'=>$path
                ]);
            }
        }
        return redirect()->back();

    }
}
