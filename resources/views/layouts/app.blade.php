<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    <title>@yield('title','Unknown')</title>
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>
    <header class="auth-header">
        <h1 @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="grid-column: 1;text-align: center;grid-column-end: 4;font-family:'Amiri';" @endif><a href="/" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="font-size:35px;" @endif>{{ __('settings.Credit') }}</a></h1>
    </header>
    <section class="auth">
        <div class="container">
            @yield('auth_content')
        </div>
    </section>

    @include('layouts._footer')

    <script src="{{ mix('js/auth.js') }}"></script>
</body>
</html>
