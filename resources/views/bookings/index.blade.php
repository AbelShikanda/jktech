@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="outer-nav--return"></div>
        <div id="viewport" class="l-viewport">
            <div class="l-wrapper">
                @include('layouts.header')
                @include('layouts.navBar')
                <ul class="l-main-content main-content">
                    <li class="l-section section">
                        <div id="hire-us" class="hire">
                            <h2>Book Consultation:</h2>

                            @if (session('error'))
                                <p style="color: red;">{{ session('error') }}</p>
                            @endif

                            @if (Session('success'))
                                <div class="text-success text-center">
                                    <strong>{{ Session('success') }}</strong>
                                </div>
                            @endif
                            

                            <form action="{{ route('bookings.store') }}" method="POST" class="work-request" id="myForm">
                                @csrf
                                <div class="work-request--options">
                                    <span class="options-a">
                                        @foreach ($services as $service)
                                            @php
                                                $checkboxId = 'opt-' . $service->id;
                                            @endphp
                                            <input id="{{ $checkboxId }}" name="service[]" type="checkbox"
                                                value="{{ $service->id }}">
                                            <label for="{{ $checkboxId }}">
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
                                        <input id="start" type="time" name="start_time" spellcheck="false" required>
                                        <label for="start_time">Start Time</label>
                                    </div>
                                    <div class="information-end">
                                        <input id="end" type="time" name="end_time" spellcheck="false" required>
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
