@if (request()->is('/'))
    <ul class="outer-nav">
        <li class="{{ request()->is('/') ? 'is-active' : '' }}">Home</li>
        <!-- <li>Works</li> -->
        <li class="{{ request()->is('about') ? 'is-active' : '' }}">About</li>
        <li class="{{ request()->is('contact') ? 'is-active' : '' }}">Contact</li>
        <li class="{{ request()->is('hire-us') ? 'is-active' : '' }}">Hire us</li>
        @include('layouts.partials.guest')
    </ul>
@elseif(request()->is('tutorials'))
    <ul class="outer-nav">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('home') }}">Hire Us</a></li>
        @include('layouts.partials.guest')
    </ul>
@elseif(request()->is('education'))
    <ul class="outer-nav">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('home') }}">Hire Us</a></li>
        @include('layouts.partials.guest')
    </ul>
@elseif(request()->is('portfolio'))
    <ul class="outer-nav">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('home') }}">Hire Us</a></li>
        @include('layouts.partials.guest')
    </ul>
@endif
