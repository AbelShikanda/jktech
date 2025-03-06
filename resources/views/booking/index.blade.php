@extends('layouts.app')

@section('content')
<h2>My Bookings</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table>
    <tr>
        <th>Date</th>
        <th>Time</th>
        <th>Actions</th>
    </tr>
    @foreach($bookings as $booking)
        <tr>
            <td>{{ $booking->date }}</td>
            <td>{{ $booking->start_time }} - {{ $booking->end_time }}</td>
            <td>
                <a href="{{ route('bookings.show', $booking->id) }}">View</a>
                <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Cancel this booking?')">Cancel</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

<a href="{{ route('bookings.create') }}">New Booking</a>
@endsection
