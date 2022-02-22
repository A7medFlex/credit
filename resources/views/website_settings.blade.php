<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    <title>website settings</title>
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>
    @include('layouts._sidebar')
    <div class="container">
        {{-- {{ $posts->links('vendor.pagination.custom-pagination') }} --}}
        @include('layouts._dashboard_header')
    </div>

    <h1 style="text-align: center">{{ __('settings.headline') }}</h1>
    <div class="inert">
        <section class="theme-manage">
            <div class="container">
                <h3>{{ __('dashboard.Lightdark') }}</h3>

                <div class="light-dark">
                    @foreach ($theme as $th )
                        @if ($th->sec_title == 'light')
                            <div class="light" data-color="light" style="background-image: url('{{ $th->image }}')">
                            </div>
                        @endif
                        @if ($th->sec_title == 'dark')
                            <div class="dark active" data-color="dark" style="background-image: url('{{ $th->image }}')"></div>
                        @endif
                    @endforeach
                </div>
                <h3>{{ __('dashboard.themetwo') }}</h3>
                <div class="dominant-colors">
                    @foreach ($theme as $th )
                        @if ($th->sec_title == 'red')
                            <div class="red" data-color="#cd3a3a" style="background-image: url('{{ $th->image }}')"></div>
                        @endif
                        @if ($th->sec_title == 'green')
                            <div class="green" data-color="#48b784" style="background-image: url('{{ $th->image }}')"></div>
                        @endif
                        @if ($th->sec_title == 'dark')
                            <div class="blue active" data-color="#da4b22" style="background-image: url('{{ $th->image }}')"></div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="container lang">
                <h3>{{ __('settings.languages') }}</h3>
                <div>
                    <span>
                        @if (Config::get('languages')[App::getLocale()] == 'Arabic')
                            {{ __('settings.arabic') }}
                        @endif
                        @if (Config::get('languages')[App::getLocale()] == 'English')
                            {{ __('settings.english') }}
                        @endif
                        @if (Config::get('languages')[App::getLocale()] == 'German')
                            {{ __('settings.german') }}
                        @endif
                    </span>

                    @foreach (Config::get('languages') as $apprev => $lang )
                        @if ($apprev != App::getLocale())
                            @if ($apprev == 'ar')
                                <a href="{{ route('switchLang',$apprev) }}">{{ __('settings.arabic') }}</a>
                            @endif
                            @if ($apprev == 'en')
                                <a href="{{ route('switchLang',$apprev) }}">{{ __('settings.english') }}</a>
                            @endif
                            @if ($apprev == 'gr')
                                <a href="{{ route('switchLang',$apprev) }}">{{ __('settings.german') }}</a>
                            @endif
                        @endif
                    @endforeach
                </div>
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
        if(localStorage.getItem('LightDark-active')){
            document.querySelectorAll('.theme-manage .light-dark div').forEach(el=>{el.classList.remove('active')})
            document.querySelector(`.theme-manage .light-dark .${localStorage.getItem('LightDark-active')}`).classList.add('active')
        }
        if(localStorage.getItem('dominant-active')){
            document.querySelectorAll('.theme-manage .dominant-colors div').forEach(el=>{el.classList.remove('active')})
            document.querySelector(`.theme-manage .dominant-colors .${localStorage.getItem('dominant-active')}`).classList.add('active')
        }
        // manage search users
        var searchIcon = document.querySelector('div.search-users i');
        searchIcon.addEventListener('click', function (e) {
        document.querySelector('div.search-users input').classList.toggle('active');
        });
        var searchInput = document.querySelector('.search-users input');
        searchInput.addEventListener('click', function (e) {
        e.stopPropagation();
        });
        document.querySelectorAll('ul.search-results li').forEach(function (li) {
        li.addEventListener('click', function (e) {
            e.stopPropagation();
        });
        });
        var usersArr = [];

        searchInput.oninput = function (e) {
        if (searchInput.value) {
            document.querySelector('ul.search-results').style.display = 'block';
            var filtering = new RegExp(e.currentTarget.value, "i");
            document.querySelectorAll('ul.search-results li').forEach(function (li) {
            usersArr.push(li);
            });
            document.querySelectorAll("ul.search-results li").forEach(function (el) {
            el.remove();
            });
            var matchedUser = usersArr.filter(function (el) {
            return el.textContent.match(filtering);
            });
            matchedUser.forEach(function (user) {
            document.querySelector('ul.search-results').appendChild(user);
            });
        } else {
            document.querySelectorAll("ul.search-results li").forEach(function (el) {
            el.remove();
            });
        }
        };

        document.addEventListener('click', function (e) {
        if (e.currentTarget != searchInput) {
            document.querySelectorAll("ul.search-results li").forEach(function (el) {
            if (e.currentTarget != el) {
                document.querySelectorAll("ul.search-results li").forEach(function (el) {
                document.querySelector('ul.search-results').style.display = 'none';
                });
            }
            });
        }
        });
        // manage side bar toggling
        let arrowToggleSideBar = document.querySelector('div.toggle-aside i');
        let sideBar = document.querySelector('aside.dash-aside');
        let settingsPage = document.querySelector('.theme-manage')
        arrowToggleSideBar.addEventListener('click',()=>{
            settingsPage.classList.toggle('inert')
            arrowToggleSideBar.classList.toggle('active');
            sideBar.classList.toggle('active');
        })
        document.addEventListener('click',(e)=>{
            if(e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")){
                settingsPage.classList.toggle('inert');
                arrowToggleSideBar.classList.toggle('active');
                sideBar.classList.toggle('active');
            }
        })
        // manage colors themes
        let lightDark = document.querySelectorAll('.theme-manage .light-dark div')
        let dominantColors = document.querySelectorAll('.theme-manage .dominant-colors div')
        lightDark.forEach(col=>{
            col.addEventListener('click',(e)=>{
                lightDark.forEach(el=>{el.classList.remove('active')})
                e.currentTarget.classList.add('active')
                localStorage.removeItem('lightDark-active')
                localStorage.setItem('LightDark-active',e.currentTarget.classList.item(0))
                if(e.currentTarget.dataset.color == 'light'){
                    document.documentElement.style.setProperty(
                        "--dominant-wmode-color",
                        '#FFFFFF'
                    );
                    document.documentElement.style.setProperty(
                        "--dominant-bmode-color",
                        '#000000'
                    );
                    localStorage.removeItem("darkLight");
                    localStorage.setItem("darkLight", "light");
                }else{
                    document.documentElement.style.setProperty(
                        "--dominant-bmode-color",
                        '#FFFFFF'
                    );
                    document.documentElement.style.setProperty(
                        "--dominant-wmode-color",
                        '#000000'
                    );
                    localStorage.removeItem("darkLight");
                    localStorage.setItem("darkLight", "dark");
                }
            })
        })
        dominantColors.forEach(col=>{
            col.addEventListener('click',(e)=>{
                dominantColors.forEach(el=>{el.classList.remove('active')})
                e.currentTarget.classList.add('active')
                localStorage.removeItem('dominant-active')
                localStorage.setItem('dominant-active',e.currentTarget.classList.item(0))
                document.documentElement.style.setProperty(
                    "--compl-2",
                    e.currentTarget.dataset.color
                );
                localStorage.removeItem("dominantColor");
                localStorage.setItem("dominantColor", e.currentTarget.dataset.color);
            })
        })

    </script>
</body>
</html>
