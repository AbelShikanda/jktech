<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contacts;
use App\Models\MpesaPayment;
use App\Models\Portfolio;
use App\Models\Services;
use App\Models\Software;
use App\Services\BookingService;
use App\Services\MpesaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $pageTitle = 'Appointment';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Appointment']];

        return view(
            'bookings.index',
            with([
                'services' => $services,
                'pageTitle' => $pageTitle,
                'breadcrumbLinks' => $breadcrumbLinks,
            ]),
        );
    }

    public function bookingStore(Request $request, MpesaService $mpesaService)
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }

        if (!$request->service) {
            return redirect()
                ->back()
                ->with([
                    'error' => 'missing services',
                ]);
        }

        $validated = $request->validate([
            'service' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'message' => '',
            'phone' => 'required|string',
        ]);

        $cleanedPhone = preg_replace('/\s+/', '', $request->phone);  // remove all spaces

        // Normalize: Convert +254 and 0 to 254
        if (strpos($cleanedPhone, '+254') === 0) {
            $cleanedPhone = substr($cleanedPhone, 1);
        } elseif (strpos($cleanedPhone, '0') === 0) {
            $cleanedPhone = '254' . substr($cleanedPhone, 1);
        }

        // Format: 254 712 345 678
        $formattedPhone = preg_replace('/^(\d{3})(\d{3})(\d{3})$/', '$1 $2 $3', $cleanedPhone);

        $service = $this->bookingService->createBooking($validated);

        if (isset($service['error'])) {
            return redirect()
                ->route('bookings.index')
                ->with([
                    'error' => $service['error'],
                ]);
        }

        // ✅ Trigger STK Push
        $phone = $formattedPhone;
        $booking = $service['booking'];
        $amount = 2000;  // You can customize this

        $stkResponse = $mpesaService->stkPushRequest($phone, $amount, $booking->id, $reason = 'payment for booking');

        // if (isset($stkResponse['error'])) {
        //     return back()->with('error', $stkResponse['error'])->with('tab', 'subscriptions');
        // }

        $mpesaPayment = MpesaPayment::create([
            'booking_id' => $booking->id,
            'payment_for' => 'booking',
            'phone_number' => $phone,
            'amount' => $amount,
            'merchant_request_id' => $stkResponse['MerchantRequestID'] ?? null,
            'checkout_request_id' => $stkResponse['CheckoutRequestID'] ?? null,
            // 'status' => 'Pending',
            'status' => 'Completed',
        ]);
        DB::commit();

        // 🚀 Show waiting page and poll for status
        return view('bookings.waiting', [
            'payment_id' => $mpesaPayment->id,
            'booking_id' => $booking->id,
        ]);
    }

    public function retryBookingPayment($id, MpesaService $mpesaService)
    {
        $booking = Booking::findOrFail($id);
        $phone = MpesaPayment::where('booking_id', $id)->latest()->value('phone_number');
        $amount = 500;

        $stkResponse = $mpesaService->stkPushRequest($phone, $amount, $booking->id, $reason = 'payment for booking');

        $payment = MpesaPayment::create([
            'booking_id' => $booking->id,
            'payment_for' => 'booking',
            'phone_number' => $phone,
            'amount' => $amount,
            'merchant_request_id' => $stkResponse['MerchantRequestID'] ?? null,
            'checkout_request_id' => $stkResponse['CheckoutRequestID'] ?? null,
            // 'status' => 'Pending',
            'status' => 'Completed',
        ]);

        return view('bookings.waiting', [
            'payment_id' => $payment->id,
            'booking_id' => $booking->id,
        ]);
    }

    public function portfolio()
    {
        $pageTitle = 'Portfolio';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Portfolio']];

        $portfolio = Portfolio::latest()->get();

        return view(
            'pages.portfolio',
            with([
                'portfolio' => $portfolio,
                'pageTitle' => $pageTitle,
                'breadcrumbLinks' => $breadcrumbLinks,
            ]),
        );
    }

    public function portfolio_details()
    {
        return view('pages.portfolio_details');
    }

    public function tutorials()
    {
        $pageTitle = 'Tutorials';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Tutorials']];

        return view(
            'pages.tutorials',
            with([
                'pageTitle' => $pageTitle,
                'breadcrumbLinks' => $breadcrumbLinks,
            ]),
        );
    }

    public function tutorial_Details()
    {
        $pageTitle = 'Tutorials';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Tutorials']];

        return view(
            'pages.tutorial_Details',
            with([
                'pageTitle' => $pageTitle,
                'breadcrumbLinks' => $breadcrumbLinks,
            ]),
        );
    }

    public function education()
    {
        $pageTitle = 'Learning';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Learning']];

        return view(
            'pages.education',
            with([
                'pageTitle' => $pageTitle,
                'breadcrumbLinks' => $breadcrumbLinks,
            ]),
        );
    }

    public function education_Details()
    {
        return view('pages.education_Details');
    }

    public function contact()
    {
        $pageTitle = 'Contact';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Contact']];

        return view('pages.contact', compact('pageTitle', 'breadcrumbLinks'));
    }

    public function contact_store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save to database
        Contacts::create($request->only(['name', 'email', 'subject', 'message']));

        // Redirect back with a success message
        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }

    public function comments()
    {
        return view('pages.comments');
    }

    public function getHolidays($month, $year)
    {
        // Fetch holidays for the given month and year
        $holidays = \App\Models\Holiday::whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get(['date']);  // Fetch only the 'date' field

        return response()->json($holidays);
    }

    public function service()
    {
        $pageTitle = 'Service';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Service']];

        return view(
            'pages.services',
            with([
                'pageTitle' => $pageTitle,
                'breadcrumbLinks' => $breadcrumbLinks,
            ]),
        );
    }

    public function downloads()
    {
        $pageTitle = 'Downloads';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Downloads']];

        $softwares = Software::with('releases')->get();

        return view(
            'pages.download',
            with([
                'pageTitle' => $pageTitle,
                'breadcrumbLinks' => $breadcrumbLinks,
                'softwares' => $softwares,
            ]),
        );
    }
}
