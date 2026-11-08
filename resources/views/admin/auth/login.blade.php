@extends('admin.layouts.app')
@section('nav')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection
@section('sidebar')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection

@section('content')
    <div class="row align-items-center h-100">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-center" action="{{ route('postLogin') }}" method="POST" novalidate>
            @csrf
            <h1 class="h5 mb-3 fw-normal">Admin sign in</h1>
            @if (Session('error') || session('error'))
                <div class="alert alert-danger py-2" role="alert">{{ Session::get('error') ?? session('error') }}</div>
            @endif
            @if (Session('success') || session('success'))
                <div class="alert alert-success py-2" role="alert">{{ Session::get('success') ?? session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger py-2 text-left" role="alert">
                    <ul class="mb-0 pl-3">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                </div>
            @endif
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ asset('/') }}">
                <img src="{{ asset('admin/assets/images/logo.png') }}" alt="JKE logo" class="w-50">
            </a>
            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" class="form-control form-control-lg" placeholder="Email address"
                    required="" autofocus="" name="email">
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password"
                    required="" name="password">
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Stay logged in </label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in</button>
            <p class="mt-5 mb-3 text-muted">© 2024</p>
        </form>
    </div>
@endsection
