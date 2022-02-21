<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update profile</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>
    @include('layouts._sidebar')
    <div class="container">
        {{-- {{ $posts->links('vendor.pagination.custom-pagination') }} --}}
        @include('layouts._dashboard_header')
    </div>
    <div class="inert">
        <div class="edit-prof-container">
            <div class="container">
                <h3 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('dashboard.updateProfile') }}</h3>
                <form action="{{ route('update-profile') }}" class="edit-profile-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="edit-img" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-right:0;margin-left:30px;" @endif>
                        <div class="old-img" style="background-image: url('{{ Storage::url(Auth::user()->user_profile_image) }}')"></div>
                        <div class="editing">
                            <i class="fas fa-camera"></i>
                        </div>
                        <input type="file" name="user_profile_image" id="user-profile-image">
                    </div>
                    <div class="data">
                        <div>
                            <i class="fas fa-user"></i>
                            <input @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-right:12px;margin-left:0px;" @endif type="text" name="first_name" placeholder="{{ __('register.first_name') }}" value="{{ Auth::user()->first_name }}">
                            @error('first_name')
                                <div class="update-pro-err" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="left:0;" @endif>{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <i class="fas fa-user"></i>
                            <input @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-right:12px;margin-left:0px;" @endif type="text" name="last_name" placeholder="{{ __('register.last_name') }}" value="{{ Auth::user()->last_name }}">
                            @error('last_name')
                                <div class="update-pro-err" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="left:0;" @endif>{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <i class="fas fa-phone"></i>
                            <input @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-right:12px;margin-left:0px;" @endif type="text" name="phone" placeholder="{{ __('register.phone') }}" value="{{ Auth::user()->phone }}">
                            @error('phone')
                                <div class="update-pro-err" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="left:0;" @endif>{{ $message }}</div>
                            @enderror
                        </div>
                        @error('country')
                            <div class="update-pro-err" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="left:0;" @endif>{{ $message }}</div>
                        @enderror
                        <div>
                            <i class="fas fa-globe-africa"></i>
                            <select @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-right:12px;margin-left:0px;" @endif name="country">
                                <option value="">{{ __('dashboard.selectCo') }}</option>
                                @foreach ( $countries as $country )
                                    @if (ucfirst(strtolower($country->name)) === Auth::user()->country)
                                        <option selected value="{{ ucfirst(strtolower($country->name)) }}">{{ ucfirst(strtolower($country->name)) }}</option>
                                    @else
                                        <option value="{{ ucfirst(strtolower($country->name)) }}">{{ ucfirst(strtolower($country->name)) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit">{{ __('dashboard.update') }}</button>
                        </div>
                    </div>
                </form>
                <div class="container">
                    <h3  @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('dashboard.updatePass') }}</h3>
                    <form action="{{ route('update-pass') }}" class="update-pass" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <i class="fas fa-key"></i>
                            <input @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-right:12px;margin-left:0px;" @endif type="password" name="password" placeholder="{{ __('register.password') }}">
                        </div>
                        <div>
                            <i class="fas fa-key"></i>
                            <input @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-right:12px;margin-left:0px;" @endif type="password" name="password_confirmation" placeholder="{{ __('register.confirm') }}">
                        </div>
                        @error('password')
                            <div class="update-pro-err">{{ $message }}</div>
                        @enderror
                        <div>
                            <button type="submit">{{ __('dashboard.update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
            @include('layouts._footer')
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
        let newImgInput = document.querySelector('.edit-profile-form .edit-img #user-profile-image');
        let oldImg = document.querySelector('.edit-profile-form .edit-img .old-img');
        newImgInput.onchange = (e)=>{
            oldImg.style.backgroundImage = `url('${URL.createObjectURL(e.currentTarget.files[0])}')`
        }
        document.querySelector('.edit-profile-form .edit-img').addEventListener('click',()=>{
            newImgInput.click();
        })
        // manage side bar toggling
        let arrowToggleSideBar = document.querySelector('div.toggle-aside i');
        let sideBar = document.querySelector('aside.dash-aside');
        let updatePage = document.querySelector('.edit-prof-container')
        arrowToggleSideBar.addEventListener('click',()=>{
            updatePage.classList.toggle('inert')
            // document.querySelector('header.user-profile-header').classList.toggle('inert')
            arrowToggleSideBar.classList.toggle('active');
            sideBar.classList.toggle('active');
        })
        document.addEventListener('click',(e)=>{
            if(e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")){
                updatePage.classList.toggle('inert');
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
