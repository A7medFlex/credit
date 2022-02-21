<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    <title>Profile</title>
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>

    @include('layouts._sidebar')

    <div class="iner-body">
        <header class="user-profile-header"
            @if ($user->user_profile_image)
                style="background-image: url('{{ Storage::url($user->user_profile_image) }}')"
            @else
                style="background:blue"
            @endif
            >
        <div class="overlay"></div>
        <div class="upi"
            @if ($user->user_profile_image)
            style="background-image: url('{{ Storage::url($user->user_profile_image) }}')"
            @else
                style="background:blue"
            @endif
        ></div>
        <div class="container">
            @include('layouts._dashboard_header')
        </div>
    </header>
    </div>
    <div class="iner-body">
        <section class="user-profile">
            <div class="container">
                <div class="user-profile-data">
                    <div>{{ $user->first_name }} {{ $user->last_name }}</div>
                    <div>{{ $user->description }}</div>
                    <div><i class="fas fa-home"></i> {{ __('dashboard.live in') }} <span>{{ $user->country }}</span></div>
                    <div><i class="fas fa-phone-alt"></i> {{ __('dashboard.contact') }} <a href="tel:{{ $user->country_code }}{{ $user->phone }}"><bdi>{{ $user->country_code }}{{ $user->phone }}</bdi></a></div>
                    <div><i class="fas fa-calendar-week"></i> {{ __('dashboard.joined') }} <span>{{ $user->created_at->diffForHumans() }}</span></div>
                </div>
                <div class="create-post-cont">
                    <span>{{ __('dashboard.recent') }}</span>
                    @if ($user->id == Auth::user()->id && Auth::user()->hasRole('donator') )
                        <span class="create-post">+ {{ __('dashboard.create') }}</span>
                    @endif
                </div>
                @if (Auth::user()->hasRole('user') || Auth::user()->hasRole('admin'))
                    <div class="no-activities" style="color: var(--compl-2);font-size: 30px;font-weight: 500;">{{ __('settings.No activities yet.') }}</div>
                @endif
                @if (Auth::user()->hasRole('donator'))
                    <div class="user-profile-posts">
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
                @endif
            </div>
        </section>
        @include('layouts._footer')
    </div>

    <script>
        // manage local storage
        if (localStorage.getItem('darkLight')) {
            if(localStorage.getItem('darkLight') == "light"){
                document.documentElement.style.setProperty(
                        "--dominant-wmode-color",
                        '#FFFFFF'
                );
                document.documentElement.style.setProperty(
                    "--dominant-bmode-color",
                    '#000000'
                );
            }else{
                document.documentElement.style.setProperty(
                        "--dominant-bmode-color",
                        '#FFFFFF'
                );
                document.documentElement.style.setProperty(
                    "--dominant-wmode-color",
                    '#000000'
                );
            }

        }
        if(localStorage.getItem('dominantColor')){
            document.documentElement.style.setProperty(
                "--compl-2",
                localStorage.getItem('dominantColor')
            );
        }

        let searchIcon = document.querySelector('div.search-users i')
        searchIcon.addEventListener('click',(e)=>{
            document.querySelector('div.search-users input').classList.toggle('active')
        })
        let searchInput =  document.querySelector('.search-users input');
        searchInput.addEventListener('click',(e)=>{
            e.stopPropagation()
        })
        document.querySelectorAll('ul.search-results li').forEach(li=>{
            li.addEventListener('click',(e)=>{
                e.stopPropagation()
            })
        })
        let usersArr = []
        searchInput.oninput = (e)=>{
            if(searchInput.value){
                document.querySelector('ul.search-results').style.display = 'block'
                let filtering = new RegExp(e.currentTarget.value, "i");
                document.querySelectorAll('ul.search-results li').forEach(li=>{
                    usersArr.push(li)
                })
                document.querySelectorAll("ul.search-results li").forEach(el=>{
                    el.remove()
                })
                // console.log(usersArr[0])
                let matchedUser = usersArr.filter(el=>{
                    return el.textContent.match(filtering)
                })
                matchedUser.forEach(user=>{
                    document.querySelector('ul.search-results').appendChild(user)
                })
            }else{
                document.querySelectorAll("ul.search-results li").forEach(el=>{
                    el.remove()
                })
            }
        }
        document.addEventListener('click',(e)=>{
            if(e.currentTarget != searchInput){
                document.querySelectorAll("ul.search-results li").forEach(el=>{
                    if(e.currentTarget != el){
                        document.querySelectorAll("ul.search-results li").forEach(el=>{
                            document.querySelector('ul.search-results').style.display = 'none'
                        })
                    }
                })
            }
        })
        // manage side bar toggling
        let arrowToggleSideBar = document.querySelector('div.toggle-aside i');
        let sideBar = document.querySelector('aside.dash-aside');
        let profilePage = document.querySelector('.user-profile')
        arrowToggleSideBar.addEventListener('click',()=>{
            profilePage.classList.toggle('inert')
            document.querySelector('header.user-profile-header').classList.toggle('inert')
            arrowToggleSideBar.classList.toggle('active');
            sideBar.classList.toggle('active');
        })
        document.addEventListener('click',(e)=>{
            if(e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")){
                profilePage.classList.toggle('inert');
                document.querySelector('header.user-profile-header').classList.toggle('inert')
                arrowToggleSideBar.classList.toggle('active');
                sideBar.classList.toggle('active');
            }
        })
    </script>
</body>
</html>
