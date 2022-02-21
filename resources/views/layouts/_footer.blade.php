<footer>
    <div class="container">
        <div class="gr">
            <a href="/diseased">{{ __('managment.Diseased Page') }}</a>
            <a href="/homeless">{{ __("managment.Homeless Page") }}</a>
            <a href="/children">{{ __('managment.Children Page') }}</a>
            <a href="/stories">{{ __("managment.Stories Page") }}</a>
        </div>
        <div class="gr">
            <a href="/FAQs">{{ __('managment.FAQs Page') }}</a>
            <a href="/about">{{ __('managment.About Page') }}</a>
            <a href="/donation">{{ __('managment.donate page') }}</a>
            <a href="{{ route('soon') }}">{{ __("managment.how it works") }}</a>
        </div>
        <div class="gr">
            <p>{{ __('settings.Find us on:') }}</p>
            <div class="social-icons">
                <a href="https://www.instagram.com/ragabolla101"><i class="fab fa-instagram"></i></a>
                <a href="https://wa.me/+201067610467"><i class="fab fa-whatsapp"></i></a>
                <a href="https://telegram.me/Ragab101"><i class="fab fa-telegram-plane"></i></a>
                <a href="https://www.linkedin.com/in/ahmed-mostafa-ragab-95ab64206/"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    <div class="lang">
        {{-- <h3>{{ __('settings.languages') }}</h3> --}}
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
    <p class="dev">{{ __('managment.Developed with love') }} <i class="fas fa-heart"></i> {{ __("managment.by Ahmed Ragab") }} || &copy; 2021 </p>
</footer>
