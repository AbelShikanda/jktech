@if(request()->is('/'))
    <nav class="l-side-nav">
        <ul class="side-nav">
            <li class="{{ request()->is('/') ? 'is-active' : '' }}"><span>Home</span></li>
            <!-- <li class="{{ request()->is('services') ? 'is-active' : '' }}"><span>Services</span></li> -->
            <li class="{{ request()->is('about') ? 'is-active' : '' }}"><span>About</span></li>
            <li class="{{ request()->is('contact') ? 'is-active' : '' }}"><span>Contact</span></li>
            <li class="{{ request()->is('hire-us') ? 'is-active' : '' }}"><span>Hire us</span></li>
        </ul>
    </nav>
@elseif(request()->is('tutorials'))
    <nav class="l-side-nav">
        <ul class="side-nav">
            <li class="{{ request()->is('tutorials') ? 'is-active' : '' }}"><span>HTML</span></li>
            <li class="{{ request()->is('tutorials/css') ? 'is-active' : '' }}"><span>CSS</span></li>
            <li class="{{ request()->is('tutorials/js') ? 'is-active' : '' }}"><span>JavaScript</span></li>
            <li class="{{ request()->is('tutorials/php') ? 'is-active' : '' }}"><span>PHP</span></li>
        </ul>
    </nav>
@elseif(request()->is('education'))
    <nav class="l-side-nav">
        <ul class="side-nav">
            <li class="{{ request()->is('education') ? 'is-active' : '' }}"><span>Courses</span></li>
            <li class="{{ request()->is('education/resources') ? 'is-active' : '' }}"><span>Resources</span></li>
            <li class="{{ request()->is('education/webinars') ? 'is-active' : '' }}"><span>Webinars</span></li>
        </ul>
    </nav>
@elseif(request()->is('portfolio'))
    <nav class="l-side-nav">
        <ul class="side-nav">
            <li class="{{ request()->is('portfolio') ? 'is-active' : '' }}"><span>E-commerce</span></li>
            <li class="{{ request()->is('portfolio/realestate') ? 'is-active' : '' }}"><span>Realestate</span></li>
        </ul>
    </nav>
@endif
