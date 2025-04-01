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
        <h1>Login
            <span class="span1"></span>
        </h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="text-box">
                <i class="fa fa-user"></i>
                <input type="email" name="email" placeholder="Email">
                <span class="span2"></span>
            </div>

            <div class="text-box">
                <i class="fa fa-lock"></i>
                <input type="password" name="password" placeholder="Password">
                <span class="span3"></span>
            </div>

            <div class="text-box">
                <label for="remember">
                    {{ __('Remember') }}
                </label>
                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="span3"></span>
            </div>

            <div class="btn-box">
                <input class="btn" type="submit" name="btn" value="Sign in">
                <span class="span_1"></span>
                <span class="span_2"></span>
                <span class="span_3"></span>
                <span class="span_4"></span>
            </div>
            </br>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
            </br>
            </br>

            @if (Route::has('register'))
                <a class="btn btn-link" href="{{ route('register') }}">
                    {{ __('Don\'t Have an Account?') }}
                </a>
            @endif
        </form>
    </div>
@endsection
