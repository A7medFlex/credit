{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif

            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
    <h1>Donator dashbaord</h1>
</body>
</html> --}}
@extends('../layouts._dashboard_layout')
@section('content')
<section class="posts-timeline">
    <div class="container">
        <div class="create-post-cont">
            @if (Auth::user()->hasRole('donator') || Auth::user()->hasRole('user'))
                <span>{{ __('dashboard.recent') }}</span>
            @endif
            @if (Auth::user()->hasRole('donator'))
                <span class="create-post">+ {{ __('dashboard.create') }}</span>
            @endif
        </div>
        @if (Auth::user()->hasRole('donator') || Auth::user()->hasRole('user'))
                <div class="filter">
                    <form action="{{ route('dashboard') }}" method="POST" id="searchForm">
                        @csrf
                        @method('POST')
                        <select name="search_country">
                            <option value="">{{ __('dashboard.selectCo') }}</option>
                            <option value="all">All</option>
                            @foreach ( $countries as $country )
                                <option value="{{ $country->name }}">{{ ucfirst(strtolower($country->name)) }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
        @endif
        <div class="whole-posts">
            @foreach($posts AS $post)
                <div class="post-layout">
                    <div class="post-owner">
                        <a href="{{ route('user-profile',['id'=> $post->user->id]) }}">
                            @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                                <span class="post-owner-image" style="margin-right: 0;margin-left:12px">
                                    @if ($post->user->user_profile_image)
                                        <img src="{{ Storage::url($post->user->user_profile_image) }}" alt="">
                                    @else
                                        <i class="fas fa-user-tie"></i>
                                    @endif
                                </span>
                            @else
                                <span class="post-owner-image">
                                    @if ($post->user->user_profile_image)
                                        <img src="{{ Storage::url($post->user->user_profile_image) }}" alt="">
                                    @else
                                        <i class="fas fa-user-tie"></i>
                                    @endif
                                </span>
                            @endif
                        </a>
                        <div>
                            <a href="{{ route('user-profile',['id'=> $post->user->id]) }}">
                                <span class="post-owner-name">{{ $post->user->first_name }} {{ $post->user->last_name }}</span>
                            </a>
                            <span class="post-owner-country">{{ $post->user->country }}</span>
                        </div>
                    </div>
                    @if ($post->images->count())
                        <div class="post-images">
                            <a href="{{ route('single-post',['id'=> $post->id]) }}">
                                <div class="img-cont">
                                    <img src="{{ Storage::url($post->images->first()->post_images) }}" alt="">
                                    <div class="post-img-overlay"></div>
                                </div>
                            </a>
                            @if ($post->images->count() > 2)
                                <div class="images_count">+{{ $post->images->count() - 1 }}</div>
                            @endif
                        </div>
                        <a href="{{ route('single-post',['id'=> $post->id]) }}">
                            <h3 class="post-title">
                                {{ $post->post_title }}
                            </h3>
                        </a>
                    @else
                        <a href="{{ route('single-post',['id'=> $post->id]) }}" class="no-img">
                            <h3 class="post-title">
                                {{ $post->post_title }}
                            </h3>
                        </a>
                        <a href="{{ route('single-post',['id'=> $post->id]) }}">
                            <h3 class="post-title">
                                {{ $post->post_title }}
                            </h3>
                        </a>
                    @endif

                    <div class="post-date">{{ $post->created_at->diffForHumans() }}</div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@include('layouts._footer')
@endsection
