@extends('layouts.app')

@section('leftSide')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection
@section('rightSide')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection

@section('content')
    <header class="login-header">

    </header>
    <div class="login-box">
        <h1>Register
            <span class="span1"></span>
        </h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <div class="text-box">
                <i class="fa fa-user"></i>
                <input type="text" name="first_name" placeholder="First Name">
                <span class="span2"></span>
            </div>

            <div class="text-box">
                <i class="fa fa-user"></i>
                <input type="text" name="last_name" placeholder="Last Name">
                <span class="span2"></span>
            </div>

            <div class="text-box">
                <i class="fa fa-user"></i>
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                    autocomplete="email">
                <span class="span2"></span>
            </div>

            <div class="text-box">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" required autocomplete="new-password" placeholder="Password">
                <span class="span3"></span>
            </div>

            <div class="text-box">
                <i class="fa fa-lock"></i>
                <input type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="password_confirmation">
                <span class="span3"></span>
            </div>

            <div class="btn-box">
                <input class="btn" type="submit" name="btn" value="Sign up">
                <span class="span_1"></span>
                <span class="span_2"></span>
                <span class="span_3"></span>
                <span class="span_4"></span>
            </div>
            </br>

            @if (Route::has('login'))
                <a class="btn btn-link" href="{{ route('login') }}">
                    {{ __('Sign In Instead?') }}
                </a>
            @endif
        </form>
    </div>
@endsection
