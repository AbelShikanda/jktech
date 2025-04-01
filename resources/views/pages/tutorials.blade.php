@extends('layouts.app')

@section('content')
<div class="main">
        <div class="search-bar">
            <input type="text" placeholder="Search" />
            <button class="right-side-button" @click="rightSide = !rightSide">
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
                    <a class="profile-menu-link active">Tutorials</a>
                    <a class="profile-menu-link">About</a>
                    <!-- <a class="profile-menu-link">Friends</a>
                        <a class="profile-menu-link">Photos</a>
                        <a class="profile-menu-link">More</a> -->
                </div>
            </div>
            <div class="timeline">
                <div class="timeline-left">
                    <div class="intro box">
                        <div class="intro-title">
                            Introduction
                            <!-- <button class="intro-menu"></button> -->
                        </div>
                        <div class="info">
                            <div class="info-item">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 503.889 503.889" fill="currentColor">
                                    <path
                                        d="M453.727 114.266H345.151V70.515c0-20.832-16.948-37.779-37.78-37.779H196.517c-20.832 0-37.78 16.947-37.78 37.779v43.751H50.162C22.502 114.266 0 136.769 0 164.428v256.563c0 27.659 22.502 50.161 50.162 50.161h403.565c27.659 0 50.162-22.502 50.162-50.161V164.428c0-27.659-22.503-50.162-50.162-50.162zm-262.99-43.751a5.786 5.786 0 015.78-5.779h110.854a5.786 5.786 0 015.78 5.779v43.751H190.737zM32 164.428c0-10.015 8.147-18.162 18.162-18.162h403.565c10.014 0 18.162 8.147 18.162 18.162v23.681c0 22.212-14.894 42.061-36.22 48.27l-167.345 48.723a58.482 58.482 0 01-32.76 0L68.22 236.378C46.894 230.169 32 210.321 32 188.109zm421.727 274.725H50.162c-10.014 0-18.162-8.147-18.162-18.161V253.258c8.063 6.232 17.254 10.927 27.274 13.845 184.859 53.822 175.358 52.341 192.67 52.341 17.541 0 7.595 1.544 192.67-52.341 10.021-2.918 19.212-7.613 27.274-13.845v167.733c.001 10.014-8.147 18.162-18.161 18.162z" />
                                </svg>
                                Join an online <a href="#">Class</a>
                            </div>
                            <div class="info-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-building" viewBox="0 0 16 16">
                                    <path
                                        d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                    <path
                                        d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                                </svg>
                                Visit my office <a href="#">Nairobi, Kenya</a>
                            </div>
                            <div class="info-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                                Reach me on <a href="https://wa.me/254759537406" target="_bland">Whatsapp</a>
                            </div>
                        </div>
                    </div>
                    <div class="event box">
                        <div class="event-wrapper">
                            <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                class="event-img" />
                            <div class="event-date">
                                <div class="event-month">Jan</div>
                                <div class="event-day">01</div>
                            </div>
                            <div class="event-title">Winter Wonderland</div>
                            <div class="event-subtitle">01st Jan, 2019 07:00AM</div>
                        </div>
                    </div>
                    <div class="pages box">
                        <div class="intro-title">
                            Courses
                            <!-- <button class="intro-menu"></button> -->
                        </div>
                        <div class="user">
                            <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                alt="" class="user-img">
                            <div class="username">Course one</div>
                        </div>
                        <div class="user">
                            <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                alt="" class="user-img">
                            <div class="username">Course one</div>
                        </div>
                        <div class="user">
                            <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                alt="" class="user-img">
                            <div class="username">Course one</div>
                        </div>
                    </div>
                </div>
                <div class="timeline-right">
                    <div class="status box">
                        <div class="status-menu">
                            <a class="status-menu-item active" href="#">Any question. how can i help?</a>
                            <!-- <a class="status-menu-item" href="#">Photos</a>
                                <a class="status-menu-item" href="#">Videos</a> -->
                        </div>
                        <div class="status-main">
                            <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                class="status-img">
                            <textarea class="status-textarea" placeholder="Ask anything.."></textarea>
                        </div>
                        <div class="status-actions">
                            <!-- <a href="#" class="status-action">
                                    <svg viewBox="-42 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M333.7 123.3c0 33.9-12.2 63.2-36.2 87.2-24 24-53.3 36.1-87.1 36.1h-.1c-33.9 0-63.2-12.1-87.1-36.1-24-24-36.2-53.3-36.2-87.2 0-33.9 12.2-63.2 36.2-87.2 24-24 53.2-36 87-36.1h.2c33.8 0 63.2 12.2 87.1 36.1 24 24 36.2 53.3 36.2 87.2zm0 0"
                                            fill="#ffbb85" />
                                        <path
                                            d="M427.2 424c0 26.7-8.5 48.3-25.3 64.3-16.5 15.7-38.4 23.7-65 23.7H90.2c-26.6 0-48.5-8-65-23.7C8.5 472.3 0 450.7 0 423.9c0-10.2.3-20.4 1-30.2a302.7 302.7 0 0112.1-64.9c3.3-10.3 7.8-20.5 13.4-30.3 5.8-10.2 12.5-19 20.1-26.3a89 89 0 0129-18.2c11.2-4.4 23.7-6.7 37-6.7 5.2 0 10.3 2.2 20 8.5l21 13.5c6.6 4.3 15.7 8.3 27 11.9a107.7 107.7 0 0033 5.3c11 0 22-1.8 33-5.3 11.2-3.6 20.3-7.6 27-12l21-13.4c9.7-6.3 14.7-8.5 20-8.5 13.3 0 25.7 2.3 37 6.7a89 89 0 0128.9 18.2c7.6 7.3 14.4 16.1 20.2 26.3 5.5 9.8 10 20 13.3 30.3a305.5 305.5 0 0112.1 64.9c.7 9.8 1 20 1 30.2zm0 0"
                                            fill="#6aa9ff" />
                                        <path
                                            d="M210.4 246.6h-.1V0c34 0 63.3 12.2 87.2 36.1 24 24 36.2 53.3 36.2 87.2 0 33.9-12.2 63.2-36.2 87.2-24 24-53.3 36.1-87.1 36.1zm0 0"
                                            fill="#f5a86c" />
                                        <path
                                            d="M427.2 424c0 26.7-8.5 48.3-25.3 64.3-16.5 15.7-38.4 23.7-65 23.7H210.2V286.5h3.3c11 0 22-1.8 33-5.3 11.2-3.6 20.3-7.6 27-12l21-13.4c9.7-6.3 14.7-8.5 20-8.5 13.3 0 25.7 2.3 37 6.7a89 89 0 0128.9 18.2c7.6 7.3 14.4 16.1 20.2 26.3 5.5 9.8 10 20 13.3 30.3a305.5 305.5 0 0112.1 64.9c.7 9.8 1 20 1 30.2zm0 0"
                                            fill="#2682ff" />
                                    </svg>
                                    People
                                </a>
                                <a href="#" class="status-action">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M87.084 192c-.456-5.272-.688-10.6-.688-16C86.404 78.8 162.34 0 256.004 0s169.6 78.8 169.6 176c0 5.392-.232 10.728-.688 16h.688c0 96.184-169.6 320-169.6 320s-169.6-223.288-169.6-320h.68zm168.92 32c36.392 1.024 66.744-27.608 67.84-64-1.096-36.392-31.448-65.024-67.84-64-36.392-1.024-66.744 27.608-67.84 64 1.096 36.392 31.448 65.024 67.84 64z"
                                            fill="#e21b1b" />
                                    </svg>
                                    Check in
                                </a>
                                <a href="#" class="status-action">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <circle cx="256" cy="256" r="256" fill="#ffca28" />
                                        <g fill="#6d4c41">
                                            <path
                                                d="M399.68 208.32c-8.832 0-16-7.168-16-16 0-17.632-14.336-32-32-32s-32 14.368-32 32c0 8.832-7.168 16-16 16s-16-7.168-16-16c0-35.296 28.704-64 64-64s64 28.704 64 64c0 8.864-7.168 16-16 16zM207.68 208.32c-8.832 0-16-7.168-16-16 0-17.632-14.368-32-32-32s-32 14.368-32 32c0 8.832-7.168 16-16 16s-16-7.168-16-16c0-35.296 28.704-64 64-64s64 28.704 64 64c0 8.864-7.168 16-16 16z" />
                                        </g>
                                        <path
                                            d="M437.696 294.688c-3.04-4-7.744-6.368-12.736-6.368H86.4c-5.024 0-9.728 2.336-12.736 6.336-3.072 4.032-4.032 9.184-2.688 14.016C94.112 390.88 170.08 448.32 255.648 448.32s161.536-57.44 184.672-139.648c1.376-4.832.416-9.984-2.624-13.984z"
                                            fill="#fafafa" />
                                    </svg>
                                    Mood
                                </a> -->
                            <button class="status-share">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="album box">
                        <div class="status-main">
                            <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                class="status-img" />
                            <div class="album-detail">
                                <div class="album-title"> New <span>Course</span></div>
                                <div class="album-date">6 hours ago</div>
                            </div>
                            <button class="intro-menu"></button>
                        </div>
                        <div class="album-content">Learn how to use AI in you business.
                            <div class="album-photos">
                                <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                    alt="" class="album-photo" />
                                <div class="album-right">
                                    <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                        alt="" class="album-photo" />
                                    <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                        alt="" class="album-photo" />
                                </div>
                            </div>
                        </div>
                        <!-- <div class="album-actions">
                            <a href="#" class="album-action">
                                <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" viewBox="0 0 24 24">
                                    <path
                                        d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" />
                                </svg>
                                87
                            </a>
                            <a href="#" class="album-action">
                                <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" class="css-i6dzq1" viewBox="0 0 24 24">
                                    <path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z" />
                                </svg>
                                20
                            </a>
                            <a href="#" class="album-action">
                                <svg stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round" class="css-i6dzq1" viewBox="0 0 24 24">
                                    <path d="M17 1l4 4-4 4" />
                                    <path d="M3 11V9a4 4 0 014-4h14M7 23l-4-4 4-4" />
                                    <path d="M21 13v2a4 4 0 01-4 4H3" />
                                </svg>
                                13
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay" @click="rightSide = false; leftSide = false" :class="{ 'active': rightSide || leftSide }">
    </div>
@endsection
