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

        $validated = $request->validate([
            'service' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'message' => 'nullable|string',
            'phone' => 'required|string',
        ]);

        $cleanedPhone = preg_replace('/\s+/', '', $request->phone);
        if (strpos($cleanedPhone, '+254') === 0) {
            $cleanedPhone = substr($cleanedPhone, 1);
        } elseif (strpos($cleanedPhone, '0') === 0) {
            $cleanedPhone = '254' . substr($cleanedPhone, 1);
        }
        $formattedPhone = preg_replace('/^(\d{3})(\d{3})(\d{3})$/', '$1 $2 $3', $cleanedPhone) ?: $cleanedPhone;

        $service = $this->bookingService->createBooking($validated);
        if (isset($service['error'])) {
            return redirect()->route('bookings.index')->with('error', $service['error']);
        }

        $booking = $service['booking'];
        $amount = 2000;
        $simulate = filter_var(env('MPESA_SIMULATE', true), FILTER_VALIDATE_BOOLEAN);
        $stkResponse = $simulate ? [] : $mpesaService->stkPushRequest($formattedPhone, $amount, $booking->id, 'payment for booking');

        $mpesaPayment = MpesaPayment::create([
            'booking_id' => $booking->id,
            'payment_for' => 'booking',
            'phone_number' => $formattedPhone,
            'amount' => $amount,
            'merchant_request_id' => $stkResponse['MerchantRequestID'] ?? null,
            'checkout_request_id' => $stkResponse['CheckoutRequestID'] ?? ('SIM-' . strtoupper(uniqid())),
            'status' => $simulate ? 'Completed' : 'Pending',
            'result_desc' => $simulate ? 'Simulated locally (MPESA_SIMULATE=true).' : null,
        ]);

        if ($simulate) {
            $booking->confirmed = true;
            $booking->save();
        }

        DB::commit();

        return view('bookings.waiting', [
            'payment_id' => $mpesaPayment->id,
            'booking_id' => $booking->id,
            'simulate' => $simulate,
        ]);
    }

    public function retryBookingPayment($id, MpesaService $mpesaService)
    {
        $booking = Booking::findOrFail($id);
        $phone = MpesaPayment::where('booking_id', $id)->latest()->value('phone_number') ?: '254700000000';
        $amount = 2000;
        $simulate = filter_var(env('MPESA_SIMULATE', true), FILTER_VALIDATE_BOOLEAN);
        $stkResponse = $simulate ? [] : $mpesaService->stkPushRequest($phone, $amount, $booking->id, 'payment for booking');

        $payment = MpesaPayment::create([
            'booking_id' => $booking->id,
            'payment_for' => 'booking',
            'phone_number' => $phone,
            'amount' => $amount,
            'merchant_request_id' => $stkResponse['MerchantRequestID'] ?? null,
            'checkout_request_id' => $stkResponse['CheckoutRequestID'] ?? ('SIM-' . strtoupper(uniqid())),
            'status' => $simulate ? 'Completed' : 'Pending',
            'result_desc' => $simulate ? 'Simulated locally (MPESA_SIMULATE=true).' : null,
        ]);

        if ($simulate) {
            $booking->confirmed = true;
            $booking->save();
        }

        return view('bookings.waiting', [
            'payment_id' => $payment->id,
            'booking_id' => $booking->id,
            'simulate' => $simulate,
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
        $pageTitle = 'Tutorial Details';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => route('tutorials'), 'label' => 'Tutorials'], ['url' => '', 'label' => 'Details']];

        return view('pages.tutorials', compact('pageTitle', 'breadcrumbLinks'));
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
        $pageTitle = 'Education Details';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => route('education'), 'label' => 'Education'], ['url' => '', 'label' => 'Details']];

        return view('pages.education', compact('pageTitle', 'breadcrumbLinks'));
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
        $holidays = \App\Models\Holiday::query()
            ->whereYear('date', $year)
            ->whereMonth('date', $month)
            ->get(['date']);

        return response()->json($holidays);
    }

    public function catalog()
    {
        $pageTitle = 'Catalog';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Catalog']];
        $services = Services::with(['serviceImage', 'serviceType'])->get();

        return view('pages.catalog', compact('pageTitle', 'breadcrumbLinks', 'services'));
    }

    public function service($id)
    {
        $pageTitle = 'Service';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Service']];
        $service = Services::with(['serviceImage', 'serviceType', 'serviceCategories'])->findOrFail($id);

        return view('pages.services', compact('pageTitle', 'breadcrumbLinks', 'service'));
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
