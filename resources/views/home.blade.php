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
                    <!-- <li class="l-section section">
                            <div class="work">
                                <h2>Services</h2>
                                <div class="work--lockup">
                                    <ul class="slider">
                                        <li class="slider--item slider--item-left">
                                            <a href="#0">
                                                <div class="slider--item-image">
                                                    <img src="{{ asset('img/work-victory.jpg') }}" alt="Victory">
                                                </div>
                                                <p class="slider--item-title">Business Consultation</p>
                                                <p class="slider--item-description">
                                                    Get expert advice on how to improve your business operations.
                                                </p>
                                            </a>
                                        </li>
                                        <li class="slider--item slider--item-left">
                                            <a href="#0">
                                                <div class="slider--item-image">
                                                    <img src="{{ asset('img/work-victory.jpg') }}" alt="Victory">
                                                </div>
                                                <p class="slider--item-title">Personal Website</p>
                                                <p class="slider--item-description">
                                                    Showcase your peronal work <br>
                                                    create a strong online presence. <br>
                                                    Share your lifestyle. <br>
                                                </p>
                                            </a>
                                        </li>
                                        <li class="slider--item slider--item-center">
                                            <a href="#0">
                                                <div class="slider--item-image">
                                                    <img src="{{ asset('img/work-metiew-smith') }}.jpg" alt="Metiew and Smith">
                                                </div>
                                                <p class="slider--item-title">Portfolio &amp; Website</p>
                                                <p class="slider--item-description">
                                                    DIsplay your creative and professional work. <br>
                                                    attract more clients and job offers. <br>
                                                    grow your skills and business. <br>
                                                </p>
                                            </a>
                                        </li>
                                        <li class="slider--item slider--item-right">
                                            <a href="#0">
                                                <div class="slider--item-image">
                                                    <img src="{{ asset('img/work-alex-nowak') }}.jpg" alt="Alex Nowak">
                                                </div>
                                                <p class="slider--item-title">Business Website</p>
                                                <p class="slider--item-description">
                                                    Represent your company <br>
                                                    create a strong online presence. <br>
                                                    showcase your products and services. <br>
                                                </p>
                                            </a>
                                        </li>
                                        <li class="slider--item slider--item-right">
                                            <a href="#0">
                                                <div class="slider--item-image">
                                                    <img src="{{ asset('img/work-alex-nowak') }}.jpg" alt="Alex Nowak">
                                                </div>
                                                <p class="slider--item-title">E-commerce Website</p>
                                                <p class="slider--item-description">
                                                    Sell your products online. <br>
                                                    manage your customer interactions. <br>
                                                    Accept online payments. <br>
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="slider--prev">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118"
                                            style="enable-background:new 0 0 150 118;" xml:space="preserve">
                                            <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                                                <path d="M561,1169C525,1155,10,640,3,612c-3-13,1-36,8-52c8-15,134-145,281-289C527,41,562,10,590,10c22,0,41,9,61,29
                            c55,55,49,64-163,278L296,510h575c564,0,576,0,597,20c46,43,37,109-18,137c-19,10-159,13-590,13l-565,1l182,180
                            c101,99,187,188,193,199c16,30,12,57-12,84C631,1174,595,1183,561,1169z" />
                                            </g>
                                        </svg>
                                    </div>
                                    <div class="slider--next">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118"
                                            style="enable-background:new 0 0 150 118;" xml:space="preserve">
                                            <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                                                <path
                                                    d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z" />
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </li> -->
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
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;"
                                            xml:space="preserve">
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
                                            xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;"
                                            xml:space="preserve">
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
                            <h2>Find A Solution For:</h2>

                            @if (session('error'))
                                <p style="color: red;">{{ session('error') }}</p>
                            @endif
                            <!-- checkout formspree.io for easy form setup -->
                            <form action="#" method="POST" class="work-request" id="myForm">
                                @csrf
                                <div class="work-request--options">
                                    <span class="options-a">
                                        <input id="opt-1" type="checkbox" value="app design">
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
                                            Mobile App Design
                                        </label>
                                        <input id="opt-2" type="checkbox" value="graphic design">
                                        <label for="opt-2">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;"
                                                xml:space="preserve">
                                                <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                                                    <path
                                                        d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                                                </g>
                                            </svg>
                                            Web App Design
                                        </label>
                                        <input id="opt-3" type="checkbox" value="motion design">
                                        <label for="opt-3">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;"
                                                xml:space="preserve">
                                                <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                                                    <path
                                                        d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                                                </g>
                                            </svg>
                                            Data Analytics
                                        </label>
                                    </span>
                                    <span class="options-b">
                                        <input id="opt-6" type="checkbox" value="marketing">
                                        <label for="opt-6">
                                            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;"
                                                xml:space="preserve">
                                                <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                                                    <path
                                                        d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                                                </g>
                                            </svg>
                                            Content Marketing
                                        </label>
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
