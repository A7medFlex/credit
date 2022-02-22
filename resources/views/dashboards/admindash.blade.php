@extends('../layouts._dashboard_layout')
@section('content')
<section class="admin-dash iner-body">
    <div class="container">
        <h2>{{ __('dashboard.welcome') }} {{ Auth::user()->first_name }}</h2>
        <div class="statics">
            <div class="donators-count">
                <i class="fas fa-hands-usd"></i>
                @if ($donators_count == 1)
                    <p>{{ __('dashboard.We have only') }} {{ $donators_count }} {{ __('dashboard.donator.') }}</p>
                @elseif ($donators_count > 1)
                    <p>{{ __('dashboard.We have') }} {{ $donators_count }} {{ __('dashboard.donators.') }}</p>
                @else
                    <p>{{ __('dashboard.We dont have any donators.') }}</p>
                @endif
            </div>
            <div class="users-count">
                <i class="fas fa-users"></i>
                @if ($users_count == 1)
                    <p>{{ __('dashboard.We have only') }} {{ $users_count }} {{ __('dashboard.user') }}</p>
                @elseif ($users_count > 1)
                    <p>{{ __('dashboard.We have') }} {{ $users_count }} {{ __('dashboard.users') }}</p>
                @else
                    <p>{{ __('dashboard.We dont have any normal users.') }}</p>
                @endif
            </div>
            <div class="admins-count">
                <i class="fas fa-users-crown"></i>
                @if ($admins_count > 1)
                    <p>{{ __('dashboard.We have') }} {{ $admins_count }} {{ __('dashboard.admin') }}</p>
                @else
                    <p>{{ __('dashboard.You\'re the only admin') }}</p>
                @endif
            </div>
            <div class="donators-posts-count">
                <i class="fas fa-newspaper"></i>
                @if ($posts_count >= 1)
                    <p>{{ __('dashboard.We have') }} {{ $posts_count }} {{ __('dashboard.donators posts') }}.</p>
                @else
                    <p>{{ __('dashboard.there is no posts') }}</p>
                @endif
            </div>
            <div class="users-asks-count">
                <i class="fas fa-hands-helping"></i>
                @if ($asks_count >= 1)
                    <p>{{ __('dashboard.We have') }} {{ $asks_count }} {{ __('dashboard.help demands') }}</p>
                @else
                    <p>{{ __('dashboard.asks for help') }}</p>
                @endif
            </div>
        </div>
        <h2>{{ __('dashboard.latest users') }}</h2>
        <div class="latest-users">
            @foreach ($allusers as $user)
                @if(! $user->hasRole('admin'))
                    <div class="user">
                        <a class="user-img" href="{{ route('user-profile',['id'=> $user->id]) }}" style="background-image: url('{{ $user->user_profile_image }}')"></a>
                        <div class="user-name-cr-date" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-left:0;margin-right:15px;" @endif>
                        <a href="{{ route('user-profile',['id'=> $user->id]) }}">
                            <span class="user-name">{{ $user->first_name }} {{ $user->last_name }}</span>
                        </a>
                        <span class="cr-date">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="user-coun-role">
                            <span>{{ $user->country }}</span>
                            @if($user->hasRole('donator'))
                                <span>{{ __('register.donator') }}</span>
                            @else
                                <span>{{ __('register.user') }}</span>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <h2>{{ __('dashboard.latest posts') }}</h2>
        <div class="latest-posts">
            @if ($admin_showing_posts->count() >= 1)
                <div class="whole-posts">
                    @foreach($admin_showing_posts AS $post)
                        <div class="post-layout">
                            <div class="post-owner">
                                <a href="{{ route('user-profile',['id'=> $post->user->id]) }}">
                                    @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                                        <span class="post-owner-image" style="margin-right: 0;margin-left:12px">
                                            @if ($post->user->user_profile_image)
                                                <img src="{{ $post->user->user_profile_image }}" alt="">
                                            @else
                                                <i class="fas fa-user-tie"></i>
                                            @endif
                                        </span>
                                    @else
                                        <span class="post-owner-image">
                                            @if ($post->user->user_profile_image)
                                                <img src="{{ $post->user->user_profile_image }}" alt="">
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
                                            <img src="{{ $post->images->first()->post_images }}" alt="">
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
            @else
                <p>{{ __('dashboard.there is no posts') }}</p>
            @endif
        </div>
        <h2>{{ __('dashboard.latest demands') }}</h2>
        <div class="latest-asks">
            {{-- we will add each ask and a link for it aswell only latest 10 --}}
            @if ($admin_showing_asks->count() >= 1)
                <div class="asks">
                    @foreach ($admin_showing_asks as $ask)
                    <a href="{{ route('single-ask',['id' => $ask->id]) }}">
                        <div class="ask-item">
                            <div class="user-img" style="background-image: url('{{ $ask->user->user_profile_image }}')"></div>
                            <div class="text" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-left:0px;margin-right:20px;" @endif>
                                <div class="ask-title">{{ $ask->post_title }}</div>
                                <div class="ask-date">{{ $ask->created_at->diffForHumans()  }}</div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @else
                <p>{{ __('dashboard.asks for help') }}</p>
            @endif
        </div>
    </div>
    @include('layouts._footer')
</section>
@endsection
