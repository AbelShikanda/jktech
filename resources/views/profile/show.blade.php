<!-- resources/views/bookings/show.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Booking Details</h2>
    <p>Date: {{ $booking->date }}</p>
    <p>Time: {{ $booking->start_time }} - {{ $booking->end_time }}</p>
    <p>Status: {{ $booking->confirmed ? 'Confirmed' : 'Pending' }}</p>

    <form action="{{ route('bookings.destroy', $booking) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Cancel Booking</button>
    </form>

    <a href="{{ route('bookings.index') }}">Back to Bookings</a>
@endsection
