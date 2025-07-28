<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'start_time', 'end_time', 'message', 'confirmed'];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Services::class, 'booking_services', 'bookings_id', 'services_id');
    }

    public static function isAvailable($date, $startTime)
    {
        return !self::where('date', $date)
            ->where('start_time', $startTime)
            ->exists();
    }

    public static function createBooking($data)
    {
        $oneHourLater = date('H:i:s', strtotime($data['start_time'] . ' +1 hour'));

        if (!self::isAvailable($data['date'], $data['start_time'])) {
            return ['status' => false, 'message' => 'This time slot is already booked.'];
        }

        $booking = self::create([
            'user_id' => $data['user_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $oneHourLater,
            'message' => $data['message'],
            'confirmed' => false
        ]);

        if (isset($data['service']) && is_array($data['service'])) {
            $booking->services()->attach($data['service']);
        }

        return $booking;
    }

    public function mpesaPayment()
    {
        return $this->hasOne(MpesaPayment::class);
    }
}
