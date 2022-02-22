<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @if (str_replace('_', '-', app()->getLocale()) == 'ar') dir='rtl' @endif>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v5.15.3/css/pro.min.css">
</head>
<body @if (str_replace('_', '-', app()->getLocale()) == 'ar')style="font-family: 'Amiri', serif;" @else style="font-family: 'Roboto', sans-serif;"  @endif>
    <div class="container">
        @include('layouts._dashboard_header')
    </div>

    @include('layouts._sidebar')
    <div class="inert">
        <section class="managment">
            <div class="container">
                <section class="landing-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.Landing Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Intro section.') }}</h4>
                    @if ($intro)
                        <form action="{{ route('edit-intro') }} " class="showing" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="images" style="background-image: url('{{ Storage::url($intro->images) }}')">
                                <input type="file" name="image"  value="{{ Storage::url($intro->images) }}">
                                <i class="fas fa-images"></i>
                            </div>
                            <textarea name="intro_text" cols="30" rows="10"
                                    placeholder="{{ __('managment.Intro content . . .') }}" value="{{ $intro->sec_text }}"
                            >{{ $intro->sec_text }}</textarea>
                            <button type="submit">{{ __('managment.Edit') }}</button>
                        </form>
                    @else
                        <form action="{{ route('manage-landing') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('POST')
                            <div>
                                <textarea name="intro_text" cols="30" rows="10"
                                    placeholder="{{ __('managment.Intro content . . .') }}"
                                ></textarea>
                                <div class="images">
                                    <input type="file" name="image">
                                    <i class="fas fa-images"></i>
                                </div>
                            </div>
                            <button type="submit">{{ __('dashboard.create') }}</button>
                        </form>
                    @endif
                    <form action="{{ route('manage-landing') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <h4>{{ __('managment.Add a landing section') }}</h4>
                            <input type="text" name="sec_title" placeholder="{{ __("managment.Section title . . .") }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}"></textarea>
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                    @foreach ($landing as $ele)
                        @if ($ele->sec_title == "intro")

                        @else
                            <form action="{{ route('edit-landing',$ele->id) }}" class="showing" enctype="multipart/form-data" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="images" style="background-image: url('{{ Storage::url($ele->images) }}')">
                                    <input type="file" name="image">
                                    <i class="fas fa-images"></i>
                                </div>
                                <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}" value="{{ $ele->sec_title }}">
                                <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}" value="{{ $ele->sec_text }}">{{ $ele->sec_text }}</textarea>
                                <button type="submit">{{ __('managment.Edit') }}</button>
                            </form>
                        @endif
                    @endforeach
                </section>
                <section class="diseased-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.Diseased Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Add a diseased section') }}</h4>
                    <form action="{{ route('manage-diseased') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}"></textarea>
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                    @foreach ($diseased as $dis)
                        <form action="{{ route('edit-diseased',$dis->id) }}" class="showing" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="images" style="background-image: url('{{ Storage::url($dis->images) }}')">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}" value="{{ $dis->sec_title }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}" value="{{ $dis->sec_text }}">{{ $dis->sec_text }}</textarea>
                            <button type="submit">{{ __('managment.Edit') }}</button>
                        </form>
                    @endforeach
                </section>
                <section class="homeless-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.Homeless Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Add a homeless section') }}</h4>
                    <form action="{{ route('manage-homeless') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}"></textarea>
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                    @foreach ($homeless as $hl)
                        <form action="{{ route('edit-homeless',$hl->id) }}" class="showing" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="images" style="background-image: url('{{ Storage::url($hl->images) }}')">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}" value="{{ $hl->sec_title }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}" value="{{ $hl->sec_text }}">{{ $hl->sec_text }}</textarea>
                            <button type="submit">{{ __('managment.Edit') }}</button>
                        </form>
                    @endforeach
                </section>
                <section class="children-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.Children Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Add a children page section') }}</h4>
                    <form action="{{ route('manage-children') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}"></textarea>
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                    @foreach ($children as $ch)
                        <form action="{{ route('edit-children',$ch->id) }}" class="showing" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="images" style="background-image: url('{{ Storage::url($ch->images) }}')">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}" value="{{ $ch->sec_title }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __("managment.Section content . . .") }}" value="{{ $ch->sec_text }}">{{ $ch->sec_text }}</textarea>
                            <button type="submit">{{ __('managment.Edit') }}</button>
                        </form>
                    @endforeach
                </section>
                <section class="stories-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.Stories Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Add a stories page section') }}</h4>
                    <form action="{{ route('manage-stories') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="text" name="sec_title" placeholder="{{ __("managment.Section title . . .") }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}"></textarea>
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                    @foreach ($stories as $st)
                        <form action="{{ route('edit-stories',$st->id) }}" class="showing" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="images" style="background-image: url('{{ Storage::url($st->images) }}')">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}" value="{{ $st->sec_title }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}" value="{{ $st->sec_text }}">{{ $st->sec_text }}</textarea>
                            <button type="submit">Edit</button>
                        </form>
                    @endforeach
                </section>
                <section class="FAQs-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.FAQs Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Add a FAQs page section') }}</h4>
                    <form action="{{ route('manage-FAQs') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}"></textarea>
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                    @foreach ($FAQs as $f)
                        <form action="{{ route('edit-FAQs',$f->id) }}" class="showing" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="images" style="background-image: url('{{ Storage::url($f->images) }}')">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}" value="{{ $f->sec_title }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __('managment.Section content . . .') }}" value="{{ $f->sec_text }}">{{ $f->sec_text }}</textarea>
                            <button type="submit">{{ __('managment.Edit') }}</button>
                        </form>
                    @endforeach
                </section>
                <section class="about-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.About Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Add a about page section') }}</h4>
                    <form action="{{ route('manage-about') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __("managment.Section content . . .") }}"></textarea>
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                    @foreach ($about as $ab)
                        <form action="{{ route('edit-about',$ab->id) }}" class="showing" enctype="multipart/form-data" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="images" style="background-image: url('{{ Storage::url($ab->images) }}')">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}" value="{{ $ab->sec_title }}">
                            <textarea name="sec_text" cols="30" rows="10" placeholder="{{ __("managment.Section content . . .") }}" value="{{ $ab->sec_text }}">{{ $ab->sec_text }}</textarea>
                            <button type="submit">{{ __('managment.Edit') }}</button>
                            {{ $ab->created_at->diffForHumans() }}
                        </form>
                    @endforeach
                </section>
                <section class="theme-page">
                    <h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>{{ __('managment.About Page') }}</h2 @if (str_replace('_', '-', app()->getLocale()) == 'ar') class="ar" @endif>
                    <h4>{{ __('managment.Add a about page section') }}</h4>
                    <form action="{{ route('manage-theme') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('POST')
                        <div>
                            <input type="text" name="sec_title" placeholder="{{ __('managment.Section title . . .') }}">
                            <div class="images">
                                <input type="file" name="image">
                                <i class="fas fa-images"></i>
                            </div>
                        </div>
                        <button type="submit">{{ __('dashboard.create') }}</button>
                    </form>
                </section>
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
        let showing = document.querySelectorAll('.images');
        showing.forEach(ele=>{
            ele.addEventListener('click',(e)=>{
                e.currentTarget.firstElementChild.click();
            })
        })

        // manage side bar toggling
        let arrowToggleSideBar = document.querySelector('div.toggle-aside i');
        let sideBar = document.querySelector('aside.dash-aside');
        let page = document.querySelector('.managment')
        arrowToggleSideBar.addEventListener('click',()=>{
            page.classList.toggle('inert')
            arrowToggleSideBar.classList.toggle('active');
            sideBar.classList.toggle('active');
        })
        document.addEventListener('click',(e)=>{
            if(e.target !== sideBar && e.target !== arrowToggleSideBar && sideBar.classList.contains("active")){
                page.classList.toggle('inert');
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
