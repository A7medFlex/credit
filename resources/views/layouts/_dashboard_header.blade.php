<header class="dash-header">
    <h1 @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="letter-spacing: 0px;font-family:'Amiri';" @endif><a href="/" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="font-size:35px;" @endif>{{ __('settings.Credit') }}</a></h1>
    <div class="user-data">
        <div class="user-info">

            <div class="search-users">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="{{ __('dashboard.searchUsers') }}">
            </div>
            <ul class="search-results">
                @foreach ($allusers as $user)
                <li>
                    <a href="{{ route('user-profile',['id'=> $user->id]) }}">
                        <span class="search-img" style="background-image: url('{{ Storage::url($user->user_profile_image) }}')"></span>
                        <span class="search-name">{{ $user->first_name }} {{ $user->last_name }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
            <a href="{{ route('user-profile',['id'=> Auth::user()->id]) }}">
                <div class="user-avatar">
                    @if (Auth::user()->user_profile_image)
                        <img src="{{ Storage::url(Auth::user()->user_profile_image) }}" alt="">
                    @else
                        <i class="fas fa-user-tie"></i>
                    @endif
                </div>
            </a>
            <a href="{{ route('user-profile',['id'=> Auth::user()->id]) }}">
                @if (str_replace('_', '-', app()->getLocale()) == 'ar')
                    <span class="user-name" style="margin-right: 12px;margin-left:0;">{{ Auth::user()->first_name }}</span>
                @else
                    <span class="user-name">{{ Auth::user()->first_name }}</span>
                @endif
            </a>
        </div>
        {{-- <div class="user-settings">
            <div class="logout-manage">

            </div>
        </div> --}}
    </div>
</header>
</div>
