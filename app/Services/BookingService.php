<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Holiday;
use App\Models\User;
use App\Models\WorkingHour;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingService
{
    public function createBooking($data)
    {
        $data['user_id'] = Auth::id();
        $date = Carbon::parse($data['date']);
        $startTime = Carbon::parse($data['start_time']);
        $endTime = $startTime->copy()->addHour();

        // 🚫 Check if the date is a holiday
        if (Holiday::where('date', $date->toDateString())->exists()) {
            return ['error' => 'This date is a holiday. Please choose another day.'];
        }

        // 🚫 Check if the day is an off-day
        $workingHour = WorkingHour::where('day_of_week', $date->format('l'))->first();
        if (!$workingHour || $workingHour->is_off_day == 1) {
            return ['error' => 'This day is an off-day. Please choose another day.'];
        }

        // 🚫 Check if the booking is within working hours
        if (
            $startTime->format('H:i:s') < $workingHour->start_time ||
            $endTime->format('H:i:s') > $workingHour->end_time
        ) {
            return ['error' => 'Bookings must be within working hours (' . $workingHour->start_time . ' - ' . $workingHour->end_time . ').'];
        }

        // 🚫 Check if the slot is already booked
        if (Booking::where('date', $data['date'])->where('start_time', $data['start_time'])->exists()) {
            return ['error' => 'This time slot is already booked.'];
        }

        // ✅ Create the booking
        $booking = Booking::create([
            'user_id' => $data['user_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $endTime,
            'message' => $data['message'],
            'confirmed' => false,
        ]);

        $booking->services()->attach($data['service']);

        // dd($booking);

        return ['success' => 'Booking successful.', 'booking' => $booking];
    }
}
