<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
    <title>Home</title>
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>
    @include('layouts._sidebar')
    {{-- adding post popup form  --}}
    <div class="adding-post-form">
        @if (Auth::user()->hasRole('donator'))
            <form action="{{ route('store-post') }}" class="add-post-form" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="create-post-word">{{ __('dashboard.createForm') }}</div>
                <div class="post-owner-adding">
                    @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                        <span class="post-owner-image" style="margin-right: 0;margin-left:12px">
                            @if (Auth::user()->user_profile_image)
                            <img src="{{ Storage::url(Auth::user()->user_profile_image) }}" alt="">
                            @else
                                <i class="fas fa-user-tie"></i>
                            @endif
                        </span>
                    @else
                        <span class="post-owner-image">
                            @if (Auth::user()->user_profile_image)
                            <img src="{{ Storage::url(Auth::user()->user_profile_image) }}" alt="">
                            @else
                                <i class="fas fa-user-tie"></i>
                            @endif
                        </span>
                    @endif
                    <div>
                        <span class="post-owner-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        <span class="post-owner-country">{{ Auth::user()->country }}</span>
                    </div>
                </div>
                <input type="text" name="post_title" placeholder="{{ __('dashboard.helptitle') }}">
                <textarea name="post_content" cols="30" rows="10" placeholder="{{ __('dashboard.helpdesc') }}"></textarea>
                <div class="post-images-adding">
                    <i class="fas fa-images"></i>
                    <input type="file" name="post_images[]" id="post-images-input" multiple >
                </div>

                <div class="images-preview">

                </div>
                @if ($errors->all())
                    <div class="adding-post-back-err">
                        @foreach ($errors->all() as $err)
                            <div class="error">{{ $err }}</div>
                        @endforeach
                    </div>
                @endif
                @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                    <div class="adding-post-err">برجاء إكمال الحقول الفارغة أولاً.</div>
                @endif
                @if (str_replace('_', '-', app()->getLocale()) == 'gr')
                    <div class="adding-post-err">Bitte füllen Sie zuerst die leeren Felder aus.</div>
                @endif
                @if (str_replace('_', '-', app()->getLocale()) == 'en')
                    <div class="adding-post-err">Please complete the empty fields first.</div>
                @endif
                <button type="submit">{{ __('dashboard.create') }}</button>
            </form>
        @endif
        {{-- here we will manage the adding user post asking help and we will send the
            the form to another route --}}
        @if (Auth::user()->hasRole('user'))
            <form action="{{ route('post-asking-help') }}" class="add-post-form" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="create-post-word">{{ __('dashboard.askHelp') }}</div>
                <div class="post-owner-adding">
                    @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                        <span class="post-owner-image" style="margin-right: 0;margin-left:12px">
                            @if (Auth::user()->user_profile_image)
                            <img src="{{ Storage::url(Auth::user()->user_profile_image) }}" alt="">
                            @else
                                <i class="fas fa-user-tie"></i>
                            @endif
                        </span>
                    @else
                        <span class="post-owner-image">
                            @if (Auth::user()->user_profile_image)
                            <img src="{{ Storage::url(Auth::user()->user_profile_image) }}" alt="">
                            @else
                                <i class="fas fa-user-tie"></i>
                            @endif
                        </span>
                    @endif
                    <div>
                        <span class="post-owner-name">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        <span class="post-owner-country">{{ Auth::user()->country }}</span>
                    </div>
                </div>
                <input type="text" name="post_title" placeholder="{{ __('dashboard.helptitle') }}">
                <textarea name="post_content" cols="30" rows="10" placeholder="{{ __('dashboard.helpdesc') }}"></textarea>
                <div class="post-images-adding">
                    <i class="fas fa-images"></i>
                    <input type="file" name="post_images[]" id="post-images-input" multiple >
                </div>

                <div class="images-preview">

                </div>
                @if ($errors->all())
                    <div class="adding-post-back-err">
                        @foreach ($errors->all() as $err)
                            <div class="error">{{ $err }}</div>
                        @endforeach
                    </div>
                @endif
                @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                    <div class="adding-post-err">برجاء إكمال الحقول الفارغة أولاً.</div>
                @endif
                @if (str_replace('_', '-', app()->getLocale()) == 'gr')
                    <div class="adding-post-err">Bitte füllen Sie zuerst die leeren Felder aus.</div>
                @endif
                @if (str_replace('_', '-', app()->getLocale()) == 'en')
                    <div class="adding-post-err">Please complete the empty fields first.</div>
                @endif
                <button type="submit">{{ __('dashboard.create') }}</button>
            </form>
        @endif
    </div>
    <div class="ov-h">
        <section class="dash-landing">
            {{-- header of dashboard for each user  --}}
            <div class="container">
                {{-- {{ $posts->links('vendor.pagination.custom-pagination') }} --}}
                @include('layouts._dashboard_header')
                @yield('content')
            </div>
        </section>
    </div>

    <script src="{{ mix('js/dashboard.js') }}"></script>
    <script>
        let filterSelect = document.querySelector('.filter select');
        filterSelect.onchange = ()=>{
            document.querySelector('.filter #searchForm').submit();
        }
    </script>
</body>
</html>
