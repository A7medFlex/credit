<header @if (str_replace('_', '-', app()->getLocale()) == 'ar') class='ar auth-header' @else class="auth-header"  @endif>
    <h1 @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="grid-column: 1;grid-column-end: 4;font-family:'Amiri';" @endif><a href="/" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="font-size:35px;" @endif>{{ __('settings.Credit') }}</a></h1>
        <div id="nav-icon1">
            <span></span>
            <span></span>
            <span></span>
        </div>
</header>
