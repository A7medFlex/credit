@extends('layouts.app')
@section('title','Reset password')
@section('auth_content')

    <h3>{{ __('register.reset') }}</h3>

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="errors status">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error">{{ $error }}</div>
                @endforeach
            @endif

            @if (session('status'))
                <div>
                    {{ session('status') }}
                </div>
            @endif
        </div>

        <div class="back">
            <i class="fal fa-arrow-left"></i>
        </div>
        <div class="auth_form">
            <div class="field active">
                <i class="fal fa-envelope-square"></i>
                <input id="email" type="email" placeholder="{{ __('register.email') }}" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <button type="submit" disabled aria-hidden="true">{{ __('register.reset_two') }}</button>
            </div>
        </div>
    </form>
@endsection
