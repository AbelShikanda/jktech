@extends('layouts.app')

@section('navBar')
    {{-- Leave this section empty to exclude the sidebar --}}
@endsection

@section('footer')
    {{-- Leave this section empty to exclude the footer --}}
@endsection

@section('content')
<section class="background-radial-gradient overflow-hidden" style="min-height: 100vh;">
    <style>
        .background-radial-gradient {
            background-color: hsl(218, 41%, 15%);
            background-image: radial-gradient(650px circle at 0% 0%,
                    hsl(218, 41%, 35%) 15%,
                    hsl(218, 41%, 30%) 35%,
                    hsl(218, 41%, 20%) 75%,
                    hsl(218, 41%, 19%) 80%,
                    transparent 100%),
                radial-gradient(1250px circle at 100% 100%,
                    hsl(218, 41%, 45%) 15%,
                    hsl(218, 41%, 30%) 35%,
                    hsl(218, 41%, 20%) 75%,
                    hsl(218, 41%, 19%) 80%,
                    transparent 100%);
        }

        #radius-shape-1 {
            height: 220px;
            width: 220px;
            top: -60px;
            left: -130px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        #radius-shape-2 {
            border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
            bottom: -60px;
            right: -110px;
            width: 300px;
            height: 300px;
            background: radial-gradient(#44006b, #ad1fff);
            overflow: hidden;
        }

        .bg-glass {
            background-color: hsla(0, 0%, 100%, 0.9) !important;
            backdrop-filter: saturate(200%) blur(25px);
        }
    </style>

    <div class="container px-4 py-5 px-md-5 text-center text-lg-start">
        <div class="row gx-lg-5 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                    Trouble logging in? <br />
                    <span style="color: hsl(218, 81%, 75%)">Reset your password</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                    Enter your registered email address and we’ll send you a link to reset your password.
                </p>
            </div>

            <div class="col-lg-6 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input id="email" type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autofocus>
                                <label class="form-label" for="email">Email Address</label>

                                @error('email')
                                    <span class="invalid-feedback d-block text-start mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Send Password Reset Link
                            </button>

                            <div class="text-center">
                                <p>Remember your password?
                                    <a href="{{ route('login') }}" class="text-primary fw-bold">Sign in</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
