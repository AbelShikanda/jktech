@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="outer-nav--return"></div>
        <div id="viewport" class="l-viewport">
            <div class="l-wrapper">
                @include('layouts.header')
                @include('layouts.navBar')
                <ul class="l-main-content main-content">
                    <!-- -------------------------------------- -->
                    <li class="l-section section section--is-active">
                        <div class="about">
                            <div class="about--banner-p">
                                <h2>We<br>believe in<br>passionate<br>people</h2>
                                <!-- <a href="#0">Career
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
                                </a> -->
                                <img src="{{ asset('img/portfolio01.png') }}" alt="About Us">
                            </div>
                            <div class="about--options-p">
                                <a href="https://printshopeld.com/" target="_blank" style="background-image: url('{{ asset('img/portfolio10.png') }}');">
                                    <!-- <h3>Portfolio</h3> -->
                                </a>
                                <a href="https://printshopeld.com/blog/" target="_blank" style="background-image: url('{{ asset('img/portfolio11.png') }}');">
                                    <!-- <h3>Tutorials</h3> -->
                                </a>
                                <a href="https://printshopeld.com/catalog/show/life-behind-bars-baseball-cap" target="_blank" style="background-image: url('{{ asset('img/portfolio12.png') }}');">
                                    <!-- <h3>Knowledge</h3> -->
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- -------------------------------------- -->
                    <li class="l-section section">
                        <div class="about">
                            <div class="about--banner-p">
                                <h2>We<br>believe in<br>passionate<br>people</h2>
                                <!-- <a href="#0">Career
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
                                </a> -->
                                <img src="{{ asset('img/portfolio02.png') }}" alt="About Us">
                            </div>
                            <div class="about--options-p">
                                <a href="http://www.1n-west.co.ke/home" target="_blank" style="background-image: url('{{ asset('img/portfolio21.png') }}');">
                                    <!-- <h3>Portfolio</h3> -->
                                </a>
                                <a href="http://www.1n-west.co.ke/properties" target="_blank" style="background-image: url('{{ asset('img/portfolio22.png') }}');">
                                    <!-- <h3>Tutorials</h3> -->
                                </a>
                                <a href="http://www.1n-west.co.ke/contact" target="_blank" style="background-image: url('{{ asset('img/portfolio23.png') }}');">
                                    <!-- <h3>Knowledge</h3> -->
                                </a>
                            </div>
                        </div>
                    </li>
                    <!-- -------------------------------------- -->
                </ul>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection
