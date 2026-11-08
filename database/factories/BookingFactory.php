<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $start = $this->faker->time('H:i:s');
        return [
            'user_id' => User::factory(),
            'date' => $this->faker->dateTimeBetween('+1 day', '+60 days')->format('Y-m-d'),
            'start_time' => $start,
            'end_time' => date('H:i:s', strtotime($start . ' +1 hour')),
            'message' => $this->faker->optional()->sentence(),
            'confirmed' => $this->faker->boolean(40),
        ];
    }
}
