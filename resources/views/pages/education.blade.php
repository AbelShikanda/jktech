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
                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                                <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                                    <path d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z"/>
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
            </ul>
        </div>
    </div>
</div>

@include('layouts.footer')

@endsection
