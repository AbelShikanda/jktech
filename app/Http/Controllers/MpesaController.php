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
        $request->validate(['id' => 'required']);
        $payment = MpesaPayment::find($request->id);

        if (!$payment) {
            return response()->json(['status' => 'Unknown']);
        }

        $webUser = auth('web')->user();
        $adminUser = auth('admin')->user();
        if (!$adminUser) {
            if (!$webUser) {
                return response()->json(['status' => 'Forbidden'], 403);
            }
            $owns = ((int) ($payment->user_id ?? 0) === (int) $webUser->id)
                || ($payment->booking_id && \App\Models\Booking::where('id', $payment->booking_id)->where('user_id', $webUser->id)->exists());
            if (!$owns) {
                return response()->json(['status' => 'Forbidden'], 403);
            }
        }

        $simulate = filter_var(config('services.mpesa.simulate', false), FILTER_VALIDATE_BOOLEAN);
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
        $checkoutRequestId = $callback['CheckoutRequestID'] ?? null;
        if (!$checkoutRequestId) {
            return response()->json(['message' => 'Missing checkout request id.'], 400);
        }

        $payment = MpesaPayment::where('checkout_request_id', $checkoutRequestId)->first();
        if (!$payment) {
            Log::warning('Mpesa callback for unknown checkout request.', ['CheckoutRequestID' => $checkoutRequestId]);
            return response()->json(['message' => 'Payment record not found.'], 404);
        }

        // Idempotency: avoid reprocessing completed callbacks.
        if (in_array($payment->status, ['Completed', 'completed'], true) && ($callback['ResultCode'] ?? null) == 0) {
            return response()->json(['message' => 'Callback already processed.'], 200);
        }

        if (($callback['ResultCode'] ?? null) == 0) {
            $metadata = collect(data_get($callback, 'CallbackMetadata.Item', []));

            $items = $metadata->mapWithKeys(function ($item) {
                return [$item['Name'] => $item];
            });

            try {
                $payment->update([
                    'result_code' => $callback['ResultCode'],
                    'result_desc' => $callback['ResultDesc'] ?? null,
                    'amount' => data_get($items, 'Amount.Value', $payment->amount),
                    'mpesa_receipt_number' => data_get($items, 'MpesaReceiptNumber.Value'),
                    'transaction_date' => isset($items['TransactionDate']['Value']) ? Carbon::createFromFormat('YmdHis', $items['TransactionDate']['Value'])->toDateTimeString() : $payment->transaction_date,
                    'phone_number' => data_get($items, 'PhoneNumber.Value', $payment->phone_number),
                    'status' => 'Completed',
                ]);

                if ($payment->booking_id) {
                    Booking::where('id', $payment->booking_id)->update(['confirmed' => true]);
                    Log::info("booking #{$payment->booking_id} marked as complete from callback.");
                }

                Log::info('Payment successfully recorded:', ['payment_id' => $payment->id]);
                return response()->json(['message' => 'Payment received and recorded.'], 200);
            } catch (\Exception $e) {
                Log::error('Payment Insertion Failed:', ['error' => $e->getMessage(), 'payment_id' => $payment->id]);
                return response()->json(['message' => 'Error saving payment.'], 500);
            }
        }

        Log::warning('Mpesa Transaction Failed:', ['ResultCode' => $callback['ResultCode'] ?? null, 'Reason' => $callback['ResultDesc'] ?? null]);

        $payment->update([
            'result_code' => $callback['ResultCode'] ?? $payment->result_code,
            'result_desc' => $callback['ResultDesc'] ?? $payment->result_desc,
            'status' => 'Failed',
        ]);

        return response()->json(['message' => 'Transaction failed', 'reason' => $callback['ResultDesc'] ?? 'Unknown'], 200);
    }
}
