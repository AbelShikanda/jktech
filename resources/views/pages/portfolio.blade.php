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
            <div class="portfolio">
                <div class="portfolio-right">
                    @foreach($catalog as $item)
                    <div class="portland box">
                        <div class="portstus-main">
                            <div class="portland-detail">
                                <div class="portland-title">{{ $item->title }} &nbsp; <span>{{ $item->description }}</span></div>
                            </div>
                            <button class="intro-menu"></button>
                            <ul class="select-dropdown__list">
                                <li data-value="1" class="select-dropdown__list-item"><a href="{{ $item->url }}"
                                        target="_blank">View the site</a></li>
                            </ul>
                        </div>
                        <div class="portland-content">
                            <div class="portland-photos">
                                <img src="{{ asset('storage/' . $item->image_one) }}" alt="" class="portland-photo" />
                                <div class="portland-right">
                                    <img src="{{ asset('storage/' . $item->image_two) }}" alt="" class="portland-photo" />
                                    <img src="{{ asset('storage/' . $item->image_three) }}" alt="" class="portland-photo" />
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
        // Toggle the dropdown when clicking the button
        $('.intro-menu').on('click', function(e) {
            e.stopPropagation(); // Prevent the event from propagating to the document

            var dropdown = $(this).next('.select-dropdown__list')[0]; // Get the dropdown for this button

            // First, close all other dropdowns
            $('.select-dropdown__list').removeClass('active');

            // Toggle this dropdown
            $(dropdown).toggleClass('active');

            // Adjust the dropdown position if necessary
            adjustDropdownPosition(dropdown);
        });

        // Close the dropdown when an item is selected
        $('.select-dropdown__list-item').on('click', function() {
            var itemValue = $(this).data('value');
            console.log(itemValue);
            $('.intro-menu span').text($(this).text()).parent().attr('data-value', itemValue);

            // Close the dropdown after an item is selected
            $('.select-dropdown__list').removeClass('active');
        });

        // Close the dropdown when clicking anywhere outside the dropdown or button
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.portstus-main')
                .length) { // Check if the click is outside the dropdown and button
                $('.select-dropdown__list').removeClass('active');
            }
        });

        // Function to ensure dropdown stays within the viewport
        function adjustDropdownPosition(dropdown) {
            const rect = dropdown.getBoundingClientRect();
            if (rect.right > window.innerWidth) {
                dropdown.style.left = "auto";
                dropdown.style.right = "0"; // Align to the right if overflowing
            }
        }
    </script>
@endsection
