<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>
    <style>
        .container {
            margin: auto auto;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            }
            .container .left div{
            margin-top:10px;
            }
            .container .left div:nth-child(1) {
            font-size: 100px;
            color: var(--compl-2);
            }
            .container .left div:nth-child(2) {
            font-size: 40px;
            color: var(--dominant-bmode-color);
            }

            .container .left div:nth-child(3) {
            font-size: 25px;
            color: var(--dominant-bmode-color);
            }
            .container .left div a {
                width: 100px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 20px;
                height:40px;
                background-color:var(--compl-2);
                color:var(--dominant-wmode-color);
                font-weight:bold;
                outline:none;
                cursor: pointer;
                padding: 5px 10px;
            }
    </style>

    <div class="container">
        <div class="left">
          <div>404</div>
          <div>{{ __('settings.Youve got the wrong page.') }}</div>
          <div>{{ __('settings.Its time to move on!') }}</div>
          <div>
            <a href="/home">{{ __("settings.home") }}</a>
          </div>
        </div>
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
    </script>
</body>
</html>
