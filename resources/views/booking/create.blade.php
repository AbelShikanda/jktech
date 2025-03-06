<!-- resources/views/bookings/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>New Booking</h2>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <label for="date">Date:</label>
        <input type="date" name="date" required>

        <label for="start_time">Start Time:</label>
        <input type="time" name="start_time" required>

        <button type="submit">Book</button>
    </form>
@endsection
