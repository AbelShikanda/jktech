<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\MpesaPayment;
use App\Models\UserBundle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MpesaController extends Controller
{
    public function checkStatus(Request $request)
    {
        $payment = MpesaPayment::find($request->id);

        if (!$payment) {
            return response()->json(['status' => 'Unknown']);
        }

        $simulate = filter_var(env('MPESA_SIMULATE', false), FILTER_VALIDATE_BOOLEAN);
        if ($simulate && in_array($payment->status, ['Pending', 'pending', null, ''], true)) {
            $payment->status = 'Completed';
            $payment->result_desc = $payment->result_desc ?: 'Simulated locally (MPESA_SIMULATE=true).';
            $payment->save();
        }

        if ($payment->status === 'Completed') {
            if ($payment->payment_for === 'bundle' && $payment->bundle_id) {
                $userId = $payment->user_id;
                $start = $payment->start_date ? Carbon::parse($payment->start_date) : now();
                $end = $payment->end_date ? Carbon::parse($payment->end_date) : now()->addMonth();

                $subscription = UserBundle::where('user_id', $userId)
                    ->where('bundle_id', $payment->bundle_id)
                    ->whereIn('status', ['active', 'expired'])
                    ->first();

                if ($subscription) {
                    if ($subscription->status === 'expired') {
                        $subscription->start_date = $start;
                        $subscription->end_date = $end;
                    } else {
                        $currentEnd = $subscription->end_date ? Carbon::parse($subscription->end_date) : now();
                        $subscription->end_date = $currentEnd->greaterThan(now())
                            ? $currentEnd->addDays(max(1, $end->diffInDays($start)))
                            : $end;
                    }
                    $subscription->status = 'active';
                    $subscription->save();
                } else {
                    UserBundle::create([
                        'user_id' => $userId,
                        'bundle_id' => $payment->bundle_id,
                        'start_date' => $start,
                        'end_date' => $end,
                        'status' => 'active',
                    ]);
                }
            }

            if ($payment->payment_for === 'booking' && $payment->booking_id) {
                Booking::where('id', $payment->booking_id)->update(['confirmed' => true]);
            }

            return response()->json(['status' => 'Completed', 'simulate' => $simulate]);
        }

        return response()->json(['status' => $payment->status]);
    }

    public function mpesaCallback(Request $request)
    {
        $mpesaResponse = $request->json()->all();

        Log::info('Mpesa Callback Full Response:', ['mpesaResponse' => $mpesaResponse]);

        if (!isset($mpesaResponse['Body']['stkCallback'])) {
            return response()->json(['message' => 'Invalid callback structure.'], 400);
        }

        $callback = $mpesaResponse['Body']['stkCallback'];

        $payment = MpesaPayment::where('checkout_request_id', $callback['CheckoutRequestID'])->first();

        if ($payment && $callback['ResultCode'] == 0) {
            $metadata = collect($callback['CallbackMetadata']['Item']);

            $items = $metadata->mapWithKeys(function ($item) {
                return [$item['Name'] => $item];
            });

            Log::info('Mpesa Payment Details logging ...');

            try {
                $payment->update([
                    'result_code' => $callback['ResultCode'],
                    'result_desc' => $callback['ResultDesc'],
                    'amount' => $items['Amount']['Value'] ?? null,
                    'mpesa_receipt_number' => $items['MpesaReceiptNumber']['Value'] ?? null,
                    'transaction_date' => isset($items['TransactionDate']['Value']) ? Carbon::createFromFormat('YmdHis', $items['TransactionDate']['Value'])->toDateTimeString() : null,
                    'phone_number' => $items['PhoneNumber']['Value'] ?? null,
                    'status' => 'Completed',
                ]);

                if ($payment->booking_id) {
                    $booking = Booking::find($payment->booking_id);
                    if ($booking) {
                        $booking->confirmed = 1;
                        $booking->save();
                        Log::info("booking #{$booking->id} marked as complete from callback.");
                    }
                }

                Log::info('Payment successfully recorded:', ['payment' => $payment]);

                return response()->json(['message' => 'Payment received and recorded.'], 200);
            } catch (\Exception $e) {
                Log::error('Payment Insertion Failed:', ['error' => $e->getMessage()]);
                return response()->json(['message' => 'Error saving payment.'], 500);
            }
        } else {
            Log::warning('Mpesa Transaction Failed:', ['ResultCode' => $callback['ResultCode'], 'Reason' => $callback['ResultDesc']]);

            MpesaPayment::create([
                'merchant_request_id' => $callback['MerchantRequestID'],
                'checkout_request_id' => $callback['CheckoutRequestID'],
                'result_code' => $callback['ResultCode'],
                'result_desc' => $callback['ResultDesc'],
                'status' => 'Failed',
            ]);

            return response()->json(['message' => 'Transaction failed', 'reason' => $callback['ResultDesc']], 200);
        }
    }
}
