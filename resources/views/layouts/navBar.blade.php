<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Topbar Start -->
<div class="container-fluid bg-dark text-white-50 py-2 px-0 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-phone-alt me-2"></small>
                <small>+254 759 537 406</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="far fa-envelope-open me-2"></small>
                <small>info@jke.co.ke</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="far fa-clock me-2"></small>
                <small>Mon - Fri : 09 AM - 09 PM</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center">
                <!-- <a class="text-white-50 ms-4" href=""><i class="fab fa-facebook-f"></i></a> -->
                <!-- <a class="text-white-50 ms-4" href=""><i class="fab fa-twitter"></i></a> -->
                <a class="text-white-50 ms-4" href="https://www.linkedin.com/in/abel-shikanda-4a68a582/"
                    target="_blank"><i class="fab fa-linkedin-in"></i></a>
                <!-- <a class="text-white-50 ms-4" href=""><i class="fab fa-instagram"></i></a> -->
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
    <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
        <h1 class="m-0">
            <img class="img-fluid me-3" src="img/logo.png" alt="" />JKE
        </h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto bg-light rounded pe-4 py-3 py-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ route('portfolio') }}" class="nav-item nav-link">Portfolio</a>
            <!-- <a href="{{ route('underConstruction') }}" class="nav-item nav-link">Our Services</a> -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Explore</a>
                <div class="dropdown-menu bg-light border-0 m-0">
                    <a href="{{ route('downloads') }}" class="dropdown-item">Downloads</a>
                    <a href="{{ route('bookings.index') }}" class="dropdown-item">Appointment</a>
                    <!-- <a href="{{ route('underConstruction') }}" class="dropdown-item">Learning</a> -->
                    <!-- <a href="{{ route('underConstruction') }}" class="dropdown-item">Help Center</a> -->
                </div>
            </div>
            <a href="{{ route('contact') }}" class="nav-item nav-link">Contact Us</a><!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <div class="nav-item dropdown">
                    <!-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Explore</a> -->
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->first_name }}
                    </a>
                    <div class="dropdown-menu bg-light border-0 m-0">
                        <a href="{{ route('profile.show') }}" class="dropdown-item">Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
    <!-- <a href="{{ route('underConstruction') }}" class="btn btn-dark px-3 d-none d-lg-block">Get A Quote</a> -->
</nav>
<!-- Navbar End -->
