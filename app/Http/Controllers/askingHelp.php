<?php

namespace App\Http\Controllers;

use App\Models\ask;
use App\Models\askComments;
use App\Models\askImages;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\askingHelpM;
use App\Models\askingHelpImages;
use Illuminate\Support\Facades\Storage;

class askingHelp extends Controller
{
    public function index()
    {
        $allusers = User::all();
        $asks = ask::with('user','images')->latest()->get();

        return view('asking_help', compact('allusers','asks'));
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $post = ask::create([
            'user_id'=>$user->id,
            'post_title'=>$request->post_title,
            'post_content'=>$request->post_content
        ]);
        if($request->hasFile('post_images')){
            foreach ($request->file('post_images') as $img) {

                $path = $img->storePublicly('public/'.$user->id.'/'.$post->id.'/asking_help_images','s3');
                $path = Storage::disk('s3')->url($path);

                // $path = $img->store('public/'.$user->id.'/'.$post->id.'/asking_help_images');
                $images = askImages::create([
                    'ask_id'=>$post->id,
                    'post_images'=>$path
                ]);
            }
        }
        return redirect()->back();

    }
    public function single($id)
    {
        $allusers = User::all();
        $post = ask::where('id','like',$id)->with('images')->first();
        $user = User::where('id','like', $post->user_id)->first();
        $comments = askComments::where('ask_id','like', $id)->with('user')->latest()->get();
        return view('single_ask',compact('post','user','allusers','comments'));
    }
    public function comment($id, Request $request)
    {
        $user = Auth::user()->id;
        $comment = askComments::create([
            'ask_id'=>$id,
            'user_id'=>$user,
            'post_comments'=>$request->comment_content
        ]);
        return redirect()->back();
    }
}
