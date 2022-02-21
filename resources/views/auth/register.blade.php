@extends('layouts.app')
@section('title','Register')
@section('auth_content')

    <h3>{{ __('register.heading') }}</h3>

    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="errors">
            @if ($errors->all())
                @foreach ($errors->all() as $err)
                    <div class="error">{{ $err }}</div>
                @endforeach
            @endif
        </div>

        <div class="back">
            <i class="fal fa-arrow-left"></i>
        </div>
        <div class="auth_form">
            <div class="field active">
                <i class="fas fa-user"></i>
                <input type="text" name="first_name" placeholder="{{ __('register.first_name') }}" autofocus value="{{ old('first_name') }}">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-user"></i>
                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('register.last_name') }}">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive user-image-filed">
                <i class="fas fa-user-alt"></i>
                <input type="file" name="user_profile_image" id="user-profile-image">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fal fa-globe-asia"></i>
                <select name="country" value="{{ old('country') }}">
                    <option value="" disabled selected>{{ __('register.country') }}</option>
                    @foreach ( $countries as $country )
                        <option value="{{ ucfirst(strtolower($country->name)) }}">{{ ucfirst(strtolower($country->name)) }}</option>
                    @endforeach
                </select>
                <select name="country_code" value="{{ old('country_code') }}">
                    <option value="" disabled selected>{{ __('register.country') }}</option>
                    @foreach ( $countries as $country )
                        <option value="+{{ $country->phonecode  }}">{{ ucfirst(strtolower($country->name)) }}</option>
                    @endforeach
                </select>
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-phone"></i>
                <span id="country_code"></span>
                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="{{ __('register.phone') }}" >
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-text"></i>
                <textarea name="description" placeholder="{{ __('register.nabza') }}">{{ old('description') }}</textarea>
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fal fa-envelope-square"></i>
                <input type="email" value="{{ old('email') }}" name="email" placeholder="{{ __('register.email') }}">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-key"></i>
                <input type="password" name="password" value="{{ old('password') }}" placeholder="{{ __('register.password') }}">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-key"></i>
                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="{{ __('register.confirm') }}">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-user-tag"></i>
                <select name="role" value="{{ old('role') }}">
                    <option value="" disabled selected>{{ __('register.role') }}</option>
                    <option value="donator">{{ __('register.donator') }}</option>
                    <option value="user">{{ __('register.user') }}</option>
                </select>
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <button type="submit" disabled aria-hidden="true">{{ __('register.submit') }}</button>
            </div>
        </div>

        <a class="already-reg" href="{{ route('login') }}">
            {{ __('register.aleardy') }}
        </a>

    </form>
@endsection
