@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="outer-nav--return"></div>
        <div id="viewport" class="l-viewport">
            <div class="l-wrapper">
                @include('layouts.header')
                @include('layouts.navBar')
                <ul class="l-main-content main-content">
                    <li class="l-section section section--is-active">
                        <div class="intro">
                            <div class="intro--banner">
                                <h1>Business<br>Intelligence<br>Solutions</h1>
                                <button class="cta">Find a solution
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118"
                                        style="enable-background:new 0 0 150 118;" xml:space="preserve">
                                        <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                                            <path
                                                d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z" />
                                        </g>
                                    </svg>
                                    <span class="btn-background"></span>
                                </button>
                                <video autoplay muted loop style="max-width: 400px; margin-bottom: 5%">
                                    <source src="{{ asset('img/gif.mp4') }}" type="video/mp4">
                                </video>
                            </div>
                            <div class="intro--options">
                                <a href="#0">
                                    <h3>Data-Driven</h3>
                                    <p>Organize, collect, analyze, and interpret data for a more competitive edge.</p>
                                </a>
                                <a href="#0">
                                    <h3>Customized Solutions</h3>
                                    <p>Get solutions tailored to your specific business for more efficienct operations.</p>
                                </a>
                                <a href="#0">
                                    <h3>Continuous Development</h3>
                                    <p>Keep up with evolving advancements and market dymanics, stay ahead of the trend.</p>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="l-section section">
                        <div class="about">
                            <div class="about--banner">
                                <h2>We<br>believe in<br>passionate<br>people</h2>
                                <a href="{{ route('portfolio') }}">portfolio
                                    <span>
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118"
                                            style="enable-background:new 0 0 150 118;" xml:space="preserve">
                                            <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                                                <path
                                                    d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                                <img src="{{ asset('img/about-visual.png') }}" alt="About Us">
                                <a href="{{ route('underConstruction') }}">Tutorials
                                    <span>
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118"
                                            style="enable-background:new 0 0 150 118;" xml:space="preserve">
                                            <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                                                <path
                                                    d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                                <a href="{{ route('underConstruction') }}">Kowledge base
                                    <span>
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118"
                                            style="enable-background:new 0 0 150 118;" xml:space="preserve">
                                            <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                                                <path
                                                    d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z" />
                                            </g>
                                        </svg>
                                    </span>
                                </a>
                                <img src="{{ asset('img/about-visual.png') }}" alt="About Us">
                            </div>
                            <div class="about--options">
                                <a href="{{ route('portfolio') }}">
                                    <h3>Portfolio</h3>
                                </a>
                                <a href="{{ route('underConstruction') }}">
                                    <h3>Tutorials</h3>
                                </a>
                                <a href="{{ route('underConstruction') }}">
                                    <h3>Knowledge</h3>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="l-section section">
                        <div class="contact">
                            <div class="contact--lockup">
                                <div class="modal">
                                    <div class="modal--information">
                                        <p>7905-00200, Nairobi, Kenya</p>
                                        <a href="mailto:ouremail@gmail.com">jkenterpriceske@gmail.com</a>
                                        <a href="tel:+148126287560">+254 759 537 406</a>
                                    </div>
                                    <ul class="modal--options">
                                        <li><a href="https://wa.me/254759537406" target="_blank"> Whatsapp </a></li>
                                        <li><a href="tel:+254759537406"> Call </a></li>
                                        <li><a href="mailto:jkenterpriceske@gmail.com">Email Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="l-section section">
                        <div id="hire-us" class="hire">
                            <h2>Book Consultation:</h2>

                            @if (session('error'))
                                <p style="color: red;">{{ session('error') }}</p>
                            @endif
                            <!-- checkout formspree.io for easy form setup -->
                            <form action="#" method="POST" class="work-request" id="myForm">
                                @csrf
                                <div class="work-request--options">
                                    <span class="options-a">
                                @foreach ($services as $service)
                                        <input id="opt-1" name="service" type="checkbox" value="app design">
                                        <label for="opt-1">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;"
                                                xml:space="preserve">
                                                <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                                                    <path
                                                        d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                                                </g>
                                            </svg>
                                            {{ $service->name }}
                                        </label>
                                @endforeach
                                    </span>
                                </div>
                                <div class="work-request--information">
                                    <div class="information-date">
                                        <input id="date" type="date" name="date" spellcheck="false" required>
                                        <label for="date">Date</label>
                                    </div>
                                    <div class="information-start">
                                        <input id="start" type="time" name="start_time" spellcheck="false"
                                            required>
                                        <label for="start_time">Start Time</label>
                                    </div>
                                    <div class="information-end">
                                        <input id="end" type="time" name="end_time" spellcheck="false"
                                            required>
                                        <label for="end_time">End Time</label>
                                    </div>
                                </div>
                                <input type="submit" value="Send Request">
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        //
    </script>
    @include('layouts.footer')
@endsection
