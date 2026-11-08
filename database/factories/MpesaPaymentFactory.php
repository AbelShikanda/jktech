<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Bundle;
use App\Models\MpesaPayment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MpesaPaymentFactory extends Factory
{
    protected $model = MpesaPayment::class;

    public function definition(): array
    {
        return [
            'booking_id' => null,
            'user_id' => User::factory(),
            'bundle_id' => null,
            'payment_for' => $this->faker->randomElement(['booking', 'bundle']),
            'merchant_request_id' => 'SIM-' . strtoupper($this->faker->bothify('????####')),
            'checkout_request_id' => 'SIM-' . strtoupper($this->faker->bothify('????####????')),
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'phone_number' => '2547' . $this->faker->numerify('########'),
            'status' => $this->faker->randomElement(['Pending', 'Completed', 'Failed']),
            'result_desc' => 'Factory placeholder payment.',
        ];
    }
}
