<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\comments;

class postComments extends Controller
{
    public function comment($id, Request $request)
    {
        $user = Auth::user()->id;
        $comment = comments::create([
            'posts_modell_id'=>$id,
            'user_id'=>$user,
            'post_comments'=>$request->comment_content
        ]);
        return redirect()->back();
    }
}
