<aside class="dash-aside" style="left: 0;">
    <a href="{{ route('user-profile',['id'=> Auth::user()->id]) }}" class="user-aside-image">
        <div style="background-image: url({{ Storage::url(Auth::user()->user_profile_image) }})"></div>
    </a>
    <a href="{{ route('user-profile',['id'=> Auth::user()->id]) }}" class="user-aside-name">
        <div>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
    </a>
    @if (str_replace('_', '-', app()->getLocale()) == 'ar')
        <a href="/home" class="pages" style="margin-left: 0px;margin-right: 25px;"><i class="fas fa-home"></i> {{ __('dashboard.home') }}</a>
        <a href="{{ route('edit-profile', ['currId'=> Auth::user()->id]) }}" class="pages" style="margin-left: 0px;margin-right: 25px;"><i class="fas fa-user-cog"></i> {{ __('dashboard.profsett') }}</a>
        <a href="{{ route('asking-help') }}" class="pages" style="margin-left: 0px;margin-right: 25px;"><i class="fas fa-hand-holding-medical"></i> {{ __('dashboard.askH') }}</a>
        <a href="{{ route('website-settings') }}" class="pages" style="margin-left: 0px;margin-right: 25px;"><i class="fas fa-moon-cloud"></i> {{ __('dashboard.theme') }}</a>
        @if (Auth::user()->hasRole('admin'))
            <a href="{{ route('manage') }}" class="pages" style="margin-left: 0px;margin-right: 25px;"><i class="fas fa-toolbox"></i> {{ __('dashboard.manage') }}</a>
        @endif
    @else
        <a href="/home" class="pages"><i class="fas fa-home"></i> {{ __('dashboard.home') }}</a>
        <a href="{{ route('edit-profile', ['currId'=> Auth::user()->id]) }}" class="pages"><i class="fas fa-user-cog"></i> {{ __('dashboard.profsett') }}</a>
        <a href="{{ route('asking-help') }}" class="pages"><i class="fas fa-hand-holding-medical"></i> {{ __('dashboard.askH') }}</a>
        <a href="{{ route('website-settings') }}" class="pages"><i class="fas fa-moon-cloud"></i></i> {{ __('dashboard.theme') }}</a>
        @if (Auth::user()->hasRole('admin'))
            <a href="{{ route('manage') }}" class="pages"><i class="fas fa-toolbox"></i> {{ __('dashboard.manage') }}</a>
        @endif
    @endif

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none">
        @method('POST')
        @csrf
    </form>
    <span class="logout" onclick="document.querySelector('#logout-form').submit();">
        {{ __('settings.Logout') }} <i class="fas fa-sign-out-alt"></i>
    </span>
</aside>
<div class="toggle-aside"><i class="fas fa-arrow-right" style="left: 0;"></i></div>
