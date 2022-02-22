<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    <title>single post</title>
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>

    {{-- {{ $user }}
    <br>
    <br>
    {{ $post }} --}}
    @include('layouts._sidebar')

    <div class="container">
        @include('layouts._dashboard_header')
    </div>

    <div class="iner-body">
            <section class="single-post-layout">
            <div class="container">
                <div class="right">
                    <div class="carsoul">
                        @if ($post->images->count())
                            <div class="post-images-carsoul">
                                <div class="images-slider" draggable="true">
                                    <img src="{{ $post->images->last()->post_images }}" alt="" id="last-clone">
                                    @foreach ($post->images as $key => $img)
                                        <img src="{{ $img->post_images }}" alt="">
                                    @endforeach
                                    <img src="{{ $post->images->first()->post_images }}" alt="" id="first-clone">
                                </div>
                            </div>
                            @if ($post->images->count() <= 1)

                            @else
                                <i class="fal fa-arrow-circle-left" id="prevBtn"></i>
                                <i class="fal fa-arrow-circle-right" id="nextBtn"></i>
                            @endif
                        @else
                            <div class="no-img">{{ $post->post_title }}</div>
                        @endif
                    </div>
                    <div class="post-data">
                        <div class="user-data">
                            <span class="user-image" style="background-image: url('{{ $user->user_profile_image }}')"></span>
                            @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                            <span class="user"style="margin-right: 15px;margin-left:0">
                                <span class="user-name">{{ $user->first_name }} {{ $user->last_name }}</span>
                                {{-- <span class="user-country">{{ $user->country }}</span> --}}
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                            </span>
                            @else
                                <span class="user">
                                    <span class="user-name">{{ $user->first_name }} {{ $user->last_name }}</span>
                                    {{-- <span class="user-country">{{ $user->country }}</span> --}}
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="post-iner-data">
                            <div class="data">
                                <h3 class="post-title">{{ $post->post_title }}</h3>
                                {{-- <p class="post-date">{{ date('F d Y | h:i:s', strtotime($post->created_at)) }}</p> --}}
                                <p class="post-content">
                                    {{ $post->post_content }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="left">
                    <h2>{{ __('dashboard.comments') }}</h2>
                    <div class="add-post-comments">
                        <form action="{{ route('post-comment',['id'=> $post->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="comment-owner">
                                <div class="commenter-img" style="background-image: url('{{ Auth::user()->user_profile_image }}')"></div>
                                @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                                    <div class="commenter-name" style="margin-right: 10px;margin-left:0;">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                @else
                                    <div class="commenter-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
                                @endif
                            </div>
                            <div class="add">
                                <input name="comment_content" type="text" class="comment_content" placeholder="{{ __('dashboard.comment') }}">
                                <button type="submit">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    @if ($comments->count() >= 1)
                        <div class="show-post-comments">
                            @foreach ($comments as $comm )
                                <div class="comm">
                                    <div class="comm-owner-data">
                                        <span class="comm-owner-img" style="background-image: url('{{ $comm->user->user_profile_image }}')"></span>
                                        @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                                            <span class="comm-owner-name" style="margin-right: 10px;margin-left:0;">{{ $comm->user->first_name }} {{ $comm->user->last_name }}</span>
                                        @else
                                            <span class="comm-owner-name">{{ $comm->user->first_name }} {{ $comm->user->last_name }}</span>
                                        @endif
                                    </div>
                                    <div class="comm-date">{{ $comm->created_at->diffForHumans() }}</div>
                                    <div class="comm-content">{{ $comm->post_comments }}</div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @include('layouts._footer')
    </div>
    <script src="{{ mix('js/post-slider.js') }}"></script>
</body>
</html>

