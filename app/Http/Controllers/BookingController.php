<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    // ✅ Show all bookings for the logged-in user
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('bookings.index', compact('bookings'));
    }

    // ✅ Show the form for creating a new booking
    public function create()
    {
        return view('bookings.create');
    }

    // ✅ Store a new booking with validation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
        ]);

        $result = $this->bookingService->createBooking($validated);

        if (isset($result['error'])) {
            return redirect()->back()->with('error', $result['error']);
        }

        return redirect()->route('bookings.index')->with('success', $result['success']);
    }

    // ✅ Show a single booking
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);  // Unauthorized access
        }
        return view('bookings.show', compact('booking'));
    }

    // ✅ Delete a booking
    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking cancelled.');
    }
}
