<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MpesaPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'user_id',
        'bundle_id',
        'start_date',
        'end_date',
        'payment_for',
        'merchant_request_id',
        'checkout_request_id',
        'result_code',
        'result_desc',
        'amount',
        'mpesa_receipt_number',
        'transaction_date',
        'phone_number',
        'status',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'transaction_date',
    ];

    // 🔁 Relationships (optional if you have related models)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bundle()
    {
        return $this->belongsTo(Bundle::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
