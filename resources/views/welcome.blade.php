<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Credit</title>
        <link rel="stylesheet" href="/css/main.css">
        <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    </head>

    <body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>
        <section class="landing">
            {{-- manage the header --}}
            @include('layouts._authHeader')
            {{-- manag the main content of landing  --}}

            @if ($intro)
                @if ($intro->count())
                <main style="background-image: url('{{ $intro->images }}');">
                    <div class="main-inner">
                        <p>{{ $intro->sec_text }}</p>
                        <a href="/home">{{ __('settings.explore') }}</a>
                    </div>
                    <div class="shadow one"></div>
                    <div class="shadow two"></div>
                </main>
                @endif
            @endif
            <nav>
                @if (Route::has('login'))
                    <ul>
                        @auth
                            <li><a href="{{ url('/home') }}">{{ __('settings.home') }}</a></li>
                        @else
                            <li><a href="{{ route('login') }}">{{ __('register.heading_two') }}</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">{{ __('register.heading') }}</a></li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </nav>
        </section>

        @if ($landing)
            <section class="hero-section">
                <div class="card-grid">
                    @foreach ($landing as $land)
                        @if ($land->sec_title == 'intro')
                        @else
                            <a class="card" href="/{{ strtolower($land->sec_title) }}">
                                <div class="card__background" style="background-image: url('{{ $land->images }}');"></div>
                                <div class="card__content">
                                    <h3 class="card__heading">{{ $land->sec_title }}</h3>
                                    <p class="card__category">{{ $land->sec_text }}</p>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

        @include('layouts._footer')

        <script src="{{ mix('js/welcome.js') }}"></script>
    </body>
</html>
