<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'date', 'start_time', 'end_time', 'confirmed'];

    public function user()
    {
        return $this->belongsTo(User::class);
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

        return self::create([
            'user_id' => $data['user_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $oneHourLater,
            'confirmed' => false
        ]);
    }
}
