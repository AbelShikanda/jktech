<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Portfolio;
use App\Models\Services;
use App\Services\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function bookings(Request $request)
    {
        $services = Services::all();
        return view('bookings.index', with([
            'services' => $services,
        ]));
    }

    public function bookingStore(Request $request)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        if (!$request->service) {
            return redirect()->back()->with([
                'error' => 'missing services',
            ]);
        }

        $validated = $request->validate([
            'service' => 'required|array',
            'date' => 'required',
            'start_time' => 'required',
        ]);

        $service = $this->bookingService->createBooking($validated);

        if (isset($service['error'])) {
            return redirect()->route('bookings.index')->with([
                'error', $service['error']
            ]);
        }

        return redirect()->route('bookings.index')->with([
            'success' => $service['success'],
        ]);
    }

    public function catalog()
    {
        $catalog = Portfolio::latest()->get();
        return view('pages.portfolio', with([
            'catalog' => $catalog,
        ]));
    }

    public function portfolio_details()
    {
        return view('pages.portfolio_details');
    }

    public function tutorials()
    {
        return view('pages.tutorials');
    }

    public function tutorial_Details()
    {
        return view('pages.tutorial_Details');
    }

    public function education()
    {
        return view('pages.education');
    }

    public function education_Details()
    {
        return view('pages.education_Details');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function contact_store()
    {
        return view('pages.contact_store');
    }

    public function comments()
    {
        return view('pages.comments');
    }

    public function get_booking()
    {
        return view('pages.get_booking');
    }

    public function add_booking()
    {
        return view('pages.add_booking');
    }

    public function update_booking()
    {
        return view('pages.update_booking');
    }

    public function reduce_booking()
    {
        return view('pages.reduce_booking');
    }

    public function delete_booking()
    {
        return view('pages.delete_booking');
    }

    public function getHolidays($month, $year)
    {
        // Fetch holidays for the given month and year
        $holidays = \App\Models\Holiday::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get(['date']);  // Fetch only the 'date' field

        return response()->json($holidays);
    }
}
