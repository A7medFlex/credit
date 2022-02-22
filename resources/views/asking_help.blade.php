@extends('../layouts._dashboard_layout')
@section('content')
<section class="posts-timeline">
    <div class="container">
        <div class="create-post-cont">
                <span>{{ __('dashboard.askH') }}</span>
            @if (Auth::user()->hasRole('user'))
                <span class="create-post">+ {{ __('dashboard.ask') }}</span>
            @endif
        </div>
       <div class="asks">
           {{-- {{ $asks }} --}}
           @foreach ($asks as $ask)
                <a href="{{ route('single-ask',['id' => $ask->id]) }}">
                    <div class="ask-item">
                        <div class="user-img" style="background-image: url('{{ $ask->user->user_profile_image }}')"></div>
                        <div class="text" @if (str_replace('_', '-', app()->getLocale()) == 'ar') style="margin-left:0px;margin-right:20px;" @endif>
                            <div class="ask-title">{{ $ask->post_title }}</div>
                            <div class="ask-date">{{ $ask->created_at->diffForHumans()  }}</div>
                        </div>
                    </div>
                </a>
           @endforeach
        </div>
    </div>
</section>
@include('layouts._footer')
@endsection
