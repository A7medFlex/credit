@props(['data','name','allusers'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    <title>{{ $name }}</title>
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>

    @guest
        <header style="position: initial;" @if (str_replace('_', '-', app()->getLocale()) == 'ar') class='ar auth-header' @else class="auth-header"  @endif>
            <h1 @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="grid-column: 1;grid-column-end: 4;font-family:'Amiri';" @endif><a href="/" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="font-size:35px;" @endif>{{ __('settings.Credit') }}</a></h1>
        </header>
    @endguest
    @auth
        @include('layouts._sidebar')
        <div class="container">
            @include('layouts._dashboard_header')
        </div>
    @endauth

    <div class="inert">
        <section class="hero-section" style="padding-top: 0;margin-top:0;">
            <h2>{{ $name }}</h2>
            <div class="card-grid">
                @foreach ($data as $da)
                    <a href="#" class="card">
                        <div class="card__background" style="background-image: url('{{ Storage::url($da->images) }}');"></div>
                        <div class="card__content">
                            <h3 class="card__heading">{{ $da->sec_title }}</h3>
                            <p class="card__category">{{ $da->sec_text }}</p>
                        </div>
                    </a>
                @endforeach
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

        // manage side bar toggling
        let arrowToggleSideBar = document.querySelector('div.toggle-aside i');
        let sideBar = document.querySelector('aside.dash-aside');
        let donatePage = document.querySelector('.hero-section')
        arrowToggleSideBar.addEventListener('click',()=>{
            donatePage.classList.toggle('inert')
            // document.querySelector('header.user-profile-header').classList.toggle('inert')
            arrowToggleSideBar.classList.toggle('active');
            sideBar.classList.toggle('active');
        })
        document.addEventListener('click',(e)=>{
            if(e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")){
                donatePage.classList.toggle('inert');
                // document.querySelector('header.user-profile-header').classList.toggle('inert')
                arrowToggleSideBar.classList.toggle('active');
                sideBar.classList.toggle('active');
            }
        })

        // manage search users
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
    </script>
</body>
</html>
