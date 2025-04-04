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
            @include('layouts.partials.profile')
            <div class="timeline">
                <div class="timeline-left">
                    <div class="intro box">
                        <div class="intro-title">
                            Introduction
                        </div>
                        <div class="info">
                            <div class="info-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-whatsapp" viewBox="0 0 16 16">
                                    <path
                                        d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
                                </svg>
                                Reach me on <a href="https://wa.me/254759537406" target="_bland">Whatsapp</a>
                            </div>
                            <div class="info-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-youtube" viewBox="0 0 16 16">
                                    <path
                                        d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z" />
                                </svg>
                                Join my channel <a href="https://www.youtube.com/channel/UC0jnIUTS851tfF8v0Esp5dA"
                                    target="_blank">Youtube</a>
                            </div>
                            <div class="info-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-building" viewBox="0 0 16 16">
                                    <path
                                        d="M4 2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zM4 5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM7.5 5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zM4.5 8a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm2.5.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5z" />
                                    <path
                                        d="M2 1a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1zm11 0H3v14h3v-2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V15h3z" />
                                </svg>
                                Visit my office <a href="{{ route('underConstruction') }}">Nairobi, Kenya</a>
                            </div>
                        </div>
                    </div>
                    <div class="booking box">
                        <div class="booking-wrapper">
                            <img src="https://msimonline.ischool.uw.edu/wp-content/uploads/sites/2/2021/04/how-to-become-a-business-intelligence-analyst.jpg"
                                class="booking-img" />
                            <div class="booking-title"><a href="{{ route('bookings.index') }}"> Book a consultation </a>
                            </div>
                            <div class="booking-subtitle">find out more about what you can do today</div>
                        </div>
                    </div>
                    <div class="classes box">
                        <div class="intro-title">
                            Take a class
                            <button class="intro-menu"></button>
                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="https://printshopeld.com/" target="_blank">View the site</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="user">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQA1xqAA9VUScOV0UCEwaBOXyzyIU1NViu21A&s"
                                alt="" class="user-img">
                            <div class="username"><a href="https://www.youtube.com/channel/UC0jnIUTS851tfF8v0Esp5dA"
                                    target="_blank">Full HTML/CSS Course</a></div>
                        </div>
                    </div>
                </div>
                <div class="timeline-right">
                    <div class="status box">
                        <div class="status-menu">
                            <a class="status-menu-item active" href="#">Any question. how can i help?</a>
                        </div>
                        <div class="status-main">
                            <img src="https://yt3.googleusercontent.com/0H-Pv3viQBfH9Q-A0zVEtUao_qHH1VR8fbRc6Fb05slh2mpONf6NOkhwYYibb5bQZgys1i3obQ=s160-c-k-c0x00ffffff-no-rj"
                                class="status-img">
                            <textarea class="status-textarea" placeholder="Ask anything.."></textarea>
                            <a href="{{ route('underConstruction') }}" class="status-share">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5" />
                                </svg>
                            </a>
                            <!-- <button class="status-share">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                    fill="currentColor" class="bi bi-arrow-up-short" viewBox="0 0 16 16">
                                                                    <path fill-rule="evenodd"
                                                                        d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5" />
                                                                </svg>
                                                            </button> -->
                        </div>
                        <div class="status-actions">
                            <!-- <p>This is your response</p> -->
                        </div>
                    </div>
                    @foreach ($faqs as $faq)
                        <div class="album box">
                            <div class="album-content px-5">
                                {{ $faq->question }}
                                <div class="album-photos">
                                    <div class="album-right">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="overlay" @click="rightSide = false; leftSide = false" :class="{ 'active': rightSide || leftSide }">
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".album.box").forEach(album => {
                album.addEventListener("click", function(event) {
                    // Prevent clicking inside from closing it immediately
                    if (!event.target.closest(".album-photos")) {
                        const photos = this.querySelector(".album-photos");

                        // Close any currently open .album-photos
                        document.querySelectorAll(".album-photos.active").forEach(openPhoto => {
                            if (openPhoto !== photos) {
                                openPhoto.classList.remove("active");
                            }
                        });

                        // Toggle current one
                        photos.classList.toggle("active");
                    }
                });
            });
        });
    </script>
@endsection
