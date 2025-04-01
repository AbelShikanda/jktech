@extends('layouts.app')

@section('content')
    <div class="main">
        <div class="search-bar">
            <button class="right-side-button {{ auth()->check() ? '' : 'd-none' }}" @click="rightSide = !rightSide">
                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                    stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </button>
        </div>
        <div class="main-container">
            <div class="profile">
                <div class="profile-avatar">
                    <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                        alt="" class="profile-img">
                    <div class="profile-name">BUSINESS INTELLIGENCE</div>
                </div>
                <!-- <a href="https://www.youtube.com/channel/UC0jnIUTS851tfF8v0Esp5dA"><img src="https://images.unsplash.com/photo-1508247967583-7d982ea01526?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2250&q=80"
                                                alt="" class="profile-cover"></a> -->
                <div class="profile-menu">
                    <a class="profile-menu-link active">Portfolio</a>
                    <a class="profile-menu-link">About</a>
                </div>
            </div>
            <div class="portfolio">
                <div class="portfolio-right">
                    <div class="portland box">
                        <div class="portstus-main">
                            <div class="portland-detail">
                                <div class="portland-title"> Web <span>App</span></div>
                            </div>
                            <button class="intro-menu"></button>
                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="https://printshopeld.com/" target="_blank">View the site</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="portland-content">Web Applicatoin.
                            <div class="portland-photos">
                                <img src="{{ asset('img/portfolio10.png') }}" alt="" class="portland-photo" />
                                <div class="portland-right">
                                    <img src="{{ asset('img/portfolio11.png') }}" alt="" class="portland-photo" />
                                    <img src="{{ asset('img/portfolio12.png') }}" alt="" class="portland-photo" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="portland box">
                        <div class="portstus-main">
                            <div class="portland-detail">
                                <div class="portland-title"> Web <span>App</span></div>
                            </div>
                            <button class="intro-menu"></button>
                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="http://www.1n-west.co.ke/home" target="_blank">View the site</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="portland-content">Web Applicatoin.
                            <div class="portland-photos">
                                <img src="{{ asset('img/portfolio21.png') }}" alt="" class="portland-photo" />
                                <div class="portland-right">
                                    <img src="{{ asset('img/portfolio22.png') }}" alt="" class="portland-photo" />
                                    <img src="{{ asset('img/portfolio23.png') }}" alt="" class="portland-photo" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay" @click="rightSide = false; leftSide = false" :class="{ 'active': rightSide || leftSide }">
    </div>

    <script>
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("intro-menu")) {
                const dropdownMenu = event.target.nextElementSibling;
                document.querySelectorAll(".dropdown-menu").forEach(menu => {
                    if (menu !== dropdownMenu) menu.classList.remove("active");
                });
                dropdownMenu.classList.toggle("active");
            } else {
                document.querySelectorAll(".dropdown-menu").forEach(menu => menu.classList.remove("active"));
            }
        });
    </script>
@endsection
