@extends('layouts.app')
@section('title','New password')
@section('auth_content')

    <h3>Enter a new password</h3>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email', $request->email) }}" autocomplete="email" autofocus>
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-key"></i>
                <input type="password" name="password" placeholder="Password">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <i class="fas fa-key"></i>
                <input type="password" name="password_confirmation" placeholder="Confirm Password">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="field inactive">
                <button type="submit" disabled aria-hidden="true">Save password</button>
            </div>
        </div>
    </form>
@endsection
