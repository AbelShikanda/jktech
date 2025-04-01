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
                    <a class="profile-menu-link active">Education</a>
                    <a class="profile-menu-link">About</a>
                </div>
            </div>

            @if (Session('error'))
                <div class="text-danger text-center">
                    <strong>{{ Session('error') }}</strong>
                </div>
            @endif

            @if (Session('success'))
                <div class="text-success text-center">
                    <strong>{{ Session('success') }}</strong>
                </div>
            @endif

            <div class="constultation">
                <div class="constultation-right">
                    <form action="{{ route('bookings.store') }}" method="POST" class="work-request" id="myForm">
                        @csrf
                        <div class="consult box">
                            <div class="consult-content">
                                <div class="consult-photos">
                                    <div class="selectMultiple">
                                        <select name="service[]" multiple data-placeholder="Add tools">
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            <span>Add tools</span>
                                            <div class="arrow"></div>
                                        </div>
                                        <ul>
                                            @foreach ($services as $service)
                                                <li>{{ $service->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="consult box">
                            <div class="consult-content">
                                <div class="consult-photoz">

                                    <!-- Date -->
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" id="date" name="date" class="form-control" required>
                                    </div>

                                    <!-- Start Time -->
                                    <div class="form-group">
                                        <label for="start_time">Start Time</label>
                                        <input type="time" id="start_time" name="start_time" class="form-control"
                                            required>
                                    </div>

                                    <!-- End Time -->
                                    <div class="form-group">
                                        <label for="end_time">End Time</label>
                                        <input type="time" id="end_time" name="end_time" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="consult">
                            <button type="submit" class="btn btn-primary">Create Booking</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="overlay" @click="rightSide = false; leftSide = false" :class="{ 'active': rightSide || leftSide }">
    </div>

    <script>
        $(document).ready(function() {
            $(".selectMultiple").each(function() {
                var select = $(this).find("select");
                var options = select.find("option");

                var active = $(this).find("div:first");
                var list = $(this).find("ul");
                var placeholder = select.data("placeholder");

                var span = active.find("span").text(placeholder);

                list.empty();
                options.each(function() {
                    var text = $(this).text();
                    if ($(this).is(":selected")) {
                        active.append($('<a />').html('<em>' + text + '</em><i></i>'));
                        span.addClass("hide");
                    } else {
                        list.append($('<li />').html(text));
                    }
                });

                // Event for clicking an option
                $(this).on("click", "ul li", function() {
                    var li = $(this);
                    var text = li.text();
                    var a = $('<a />').html('<em>' + text + '</em><i></i>').hide();

                    active.append(a);
                    a.slideDown(400, function() {
                        setTimeout(function() {
                            a.addClass("shown");
                            span.addClass("hide");
                            select.find("option").filter(function() {
                                return $(this).text().trim() === text;
                            }).prop("selected", true);
                        }, 500);
                    });

                    li.slideUp(400, function() {
                        li.remove();
                    });
                });

                // Event for removing selected option
                $(this).on("click", "div a", function() {
                    var self = $(this);
                    var text = self.children("em").text();

                    self.addClass("remove");
                    setTimeout(function() {
                        self.animate({
                            width: 0,
                            height: 0,
                            padding: 0,
                            margin: 0
                        }, 300, function() {
                            var li = $('<li />').text(text).addClass("notShown")
                                .appendTo(list);
                            li.slideDown(400, function() {
                                li.removeClass();
                                select.find("option").filter(function() {
                                    return $(this).text().trim() ===
                                        text;
                                }).prop("selected", false);
                                if (!select.find("option:selected")
                                    .length) {
                                    span.removeClass("hide");
                                }
                            });
                            self.remove();
                        });
                    }, 300);
                });

                // Toggle dropdown
                $(this).on("click", ".arrow, span", function() {
                    $(this).closest(".selectMultiple").toggleClass("open");
                });

                // Close when clicking outside
                $(document).click(function(e) {
                    if (!$(e.target).closest(".selectMultiple").length) {
                        $(".selectMultiple").removeClass("open");
                    }
                });
            });
        });
    </script>
@endsection
