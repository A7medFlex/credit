@extends('layouts.app')
@section('title','Log in')
@section('auth_content')
    <h3>{{ __('register.heading_two') }}</h3>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="errors">
            @if ($errors->all())
                @foreach ($errors->all() as $err)
                    <div class="error">{{ $err }}</div>
                @endforeach
            @endif
        </div>
        @if (session('status'))
            <div>
                {{ session('status') }}
            </div>
        @endif
        <div class="back">
            <i class="fal fa-arrow-left"></i>
        </div>
        <div class="auth_form">
            <div class="field active">
                <i class="fal fa-envelope-square"></i>
                <input type="email" name="email" placeholder="{{ __('register.email') }}" required autofocus>
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-key"></i>
                <input type="password" name="password" placeholder="{{ __('register.password') }}" required>
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <button type="submit" disabled aria-hidden="true">{{ __('register.heading_two') }}</button>
            </div>
        </div>

        <div class="remember-me">
            <input type="checkbox" name="remember">
            <span @if (str_replace('_', '-', app()->getLocale()) == 'ar') style='margin-left:0;margin-right:10px;' @endif>{{ __('register.remember') }}</span>
            @if (Route::has('password.request'))
                    <a @if (str_replace('_', '-', app()->getLocale()) == 'ar') style='margin-right:50px;margin-left:0;' @endif class="forget-pass" href="{{ route('password.request') }}">
                        {{ __('register.forget') }}
                    </a>
            @endif
        </div>

    </form>
@endsection
