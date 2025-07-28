<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\MpesaPayment;
use App\Models\UserBundle;
use App\Services\MpesaService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function profile()
    {
        $pageTitle = 'Profile';
        $breadcrumbLinks = [['url' => '/', 'label' => 'Home'], ['url' => '', 'label' => 'Profile']];

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your profile.');
        }

        $bookings = $user->bookings()->with('services')->get();
        $transactions = $user->payments()->latest()->get();
        $subscriptionTransactions = $user->mpesaPayments()->get();
        $allTransactions = $transactions
            ->merge($subscriptionTransactions)
            ->sortByDesc('created_at')  // or 'transaction_date'
            ->values();
        $bundles = Bundle::all();

        // 👇 Get subscriptions that expired in the last 7 days
        $recentlyExpired = $user
            ->subscriptions()
            ->where('status', 'expired')
            ->where('end_date', '>=', now()->subDays(7))
            ->get();

        return view('profile.index', [
            'pageTitle' => $pageTitle,
            'breadcrumbLinks' => $breadcrumbLinks,
            'bookings' => $bookings,
            'transactions' => $allTransactions,
            'bundles' => $bundles,
            'recentlyExpired' => $recentlyExpired,
        ]);
    }

    private function normalizePhone($phone)
    {
        $phone = preg_replace('/\s+/', '', $phone);

        if (str_starts_with($phone, '+254')) {
            return substr($phone, 1);
        }

        if (str_starts_with($phone, '0')) {
            return '254' . substr($phone, 1);
        }

        return $phone;
    }

    private function createMpesaPayment(
        array $response,
        string $phone,
        float $amount,
        int $bundle_id,
        int $user_id,
        $startDate,
        $endDate,
    ) {
        // dd('these are the dates', $startDate, $endDate);
        return MpesaPayment::create([
            'user_id' => $user_id,
            'bundle_id' => $bundle_id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'payment_for' => 'bundle',
            'merchant_request_id' => $response['MerchantRequestID'] ?? null,
            'checkout_request_id' => $response['CheckoutRequestID'] ?? null,
            'amount' => $amount,
            'phone_number' => $phone,
            'status' => 'Completed',
            // 'status' => 'pending',
        ]);
    }

    protected function getActiveSubscription($user, $bundle)
    {
        return $user
            ->subscriptions()
            ->where('bundle_id', $bundle->id)
            ->where('status', 'active')
            ->first();
    }

    protected function calculateSubscriptionDates($bundle, $now)
    {
        $daysToAdd = match ($bundle->duration_unit) {
            'day' => $bundle->duration,
            'week' => $bundle->duration * 7,
            'month' => $bundle->duration * 30,
            'year' => $bundle->duration * 365,
            default => 0,
        };

        $startDate = $bundle->trial_days > 0 ? $now->copy()->addDays($bundle->trial_days) : $now;
        $endDate = $startDate->copy()->addDays($daysToAdd);

        return [$startDate, $endDate];
    }

    public function subscribe(Request $request, $bundleId, MpesaService $mpesaService)
    {
        $user = Auth::user();
        $bundle = Bundle::findOrFail($bundleId);

        if (!$user->phone) {
            return back()
                ->with('error', 'You must add a phone number to proceed with payment.')
                ->with('tab', 'edit');
        }

        $phone = $this->normalizePhone($user->phone);
        // $now = now();

        $startDate = now();
        [$startDate, $endDate] = $this->calculateSubscriptionDates($bundle, $startDate);

        $mpesa = $mpesaService->stkPushRequest($phone, $bundle->price, null, 'payment for bundle');

        // if (isset($mpesa['error'])) {
        //     return back()->with('error', $mpesa['error'])->with('tab', 'subscriptions');
        // }

        $payment = $this->createMpesaPayment($mpesa, $phone, $bundle->price, $bundle->id, auth()->id(), $startDate, $endDate);

        return view('profile.waiting', [
            'payment_id' => $payment->id,
            'booking_id' => $bundle->id,
            'retry_url' => route('subscription.retry', $bundle->id),
        ]);
    }

    public function retrySubscription(Request $request, $bundleId, MpesaService $mpesaService)
    {
        return $this->subscribe($request, $bundleId, $mpesaService);
    }

    public function renew($subscriptionId, MpesaService $mpesaService)
    {
        $subscription = UserBundle::findOrFail($subscriptionId);
        $user = auth()->user();

        if ($subscription->user_id !== $user->id) {
            abort(403);
        }

        $bundle = $subscription->bundle;

        if (!$user->phone) {
            return back()
                ->with('error', 'You must add a phone number to proceed with payment.')
                ->with('tab', 'edit');
        }

        $phone = $this->normalizePhone($user->phone);
        // $now = now();

        $existingSubscription = $this->getActiveSubscription($user, $bundle);

        $startDate = $existingSubscription->end_date ?? now();
        [$startDate, $endDate] = $this->calculateSubscriptionDates($bundle, $startDate);

        // dd($startDate, $endDate);

        $mpesa = $mpesaService->stkPushRequest($phone, $bundle->price, null, 'payment for bundle');

        // if (isset($mpesa['error'])) {
        //     return back()->with('error', $mpesa['error'])->with('tab', 'subscriptions');
        // }

        $payment = $this->createMpesaPayment($mpesa, $phone, $bundle->price, $bundle->id, auth()->id(), $startDate, $endDate);

        return view('profile.waiting', [
            'payment_id' => $payment->id,
            'booking_id' => $bundle->id,
            'retry_url' => route('subscription.renew', $subscriptionId),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'town' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $validator->validated();

        // ✅ Normalize phone if provided
        if (!empty($data['phone'])) {
            $data['phone'] = $this->normalizePhone($data['phone']);
        }

        $user->update($data);

        return back()
            ->with('success', 'Your profile has been updated successfully.')
            ->with('tab', 'edit');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.'])->withInput();
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Your password has been updated successfully.');
    }
}
