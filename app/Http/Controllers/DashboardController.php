<?php

namespace App\Http\Controllers;

use App\Models\ask;
use App\Models\ImagesModel;
use App\Models\PostsModel;
use App\Models\PostsModell;
use App\Models\Countries;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::with('posts','posts.images')->paginate(1);
        $posts = PostsModell::with('user', 'images')->latest()->get();
        if($request->has('search_country')){
            if($request->search_country == 'all'){
                $posts = PostsModell::with('user', 'images')->latest()->get();
            }else{
                $posts = PostsModell::whereHas('user', function ($query) use($request){
                    $query->where('country','like', $request->search_country);
                })->with('user', 'images')->latest()->get();
            }
        }
        $countries = Countries::all();
        $admin_showing_posts = PostsModell::with('user', 'images')->latest()->take(10)->get();
        $admin_showing_asks = ask::with('user', 'images')->latest()->take(10)->get();
        $posts_count = PostsModell::all()->count();
        $asks_count = ask::all()->count();
        $allusers = User::latest()->get();
        $admins_count = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'admin');
            }
        )->count();
        $donators_count = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'donator');
            }
        )->count();
        $users_count = User::whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'user');
            }
        )->count();
        if (Auth::user()->hasRole('user')) {
            return view('dashboards.userdash', compact('posts', 'allusers','countries'));
        } elseif (Auth::user()->hasRole('donator')) {
            return view('dashboards.donatordash', compact('posts', 'allusers','countries'));
        } elseif (Auth::user()->hasRole('admin')) {

            return view('dashboards.admindash',
                compact(
                    'allusers',
                    'admins_count',
                    'donators_count',
                    'users_count',
                    'posts_count',
                    'asks_count',
                    'admin_showing_posts',
                    'admin_showing_asks'
                )
            );
        }
    }
}
