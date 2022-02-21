<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    <title>Comming soon</title>
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;display:flex;justify-content:center;align-items:center;height:100vh;" @else style="font-family: 'Roboto', sans-serif;display:flex;justify-content:center;align-items:center;height:100vh;"  @endif>
    <div class="soon" style="font-size: 30px;color: var(--compl-2);font-weight: 500;">{{ __('settings.soon') }}</div>
</body>
</html>
