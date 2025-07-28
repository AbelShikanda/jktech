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
                    Join our platform <br />
                    <span style="color: hsl(218, 81%, 75%)">and grow with us</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                    Create your account to get access to our full range of tools and services tailored for your success.
                </p>
            </div>

            <div class="col-lg-6 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass">
                    <div class="card-body px-4 py-5 px-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- First Name -->
                            <div class="form-outline mb-4">
                                <input type="text" id="first_name" name="first_name" class="form-control" required />
                                <label class="form-label" for="first_name">First Name</label>
                            </div>

                            <!-- Last Name -->
                            <div class="form-outline mb-4">
                                <input type="text" id="last_name" name="last_name" class="form-control" required />
                                <label class="form-label" for="last_name">Last Name</label>
                            </div>

                            <!-- Email -->
                            <div class="form-outline mb-4">
                                <input type="email" id="email" name="email" class="form-control" required />
                                <label class="form-label" for="email">Email Address</label>
                            </div>

                            <!-- Password -->
                            <div class="form-outline mb-4">
                                <input type="password" id="password" name="password" class="form-control" required />
                                <label class="form-label" for="password">Password</label>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-outline mb-4">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required />
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary btn-block mb-4">
                                Register
                            </button>

                            <!-- Already have an account -->
                            <div class="text-center">
                                <p>Already have an account?
                                    <a href="{{ route('login') }}" class="text-primary fw-bold">Sign in</a>
                                </p>
                            </div>

                            <!-- Optional Social Buttons -->
                            <div class="text-center">
                                <p>or sign up with:</p>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-google"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button type="button" class="btn btn-link btn-floating mx-1">
                                    <i class="fab fa-github"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
