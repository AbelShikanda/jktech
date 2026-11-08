<?php

namespace Database\Factories;

use App\Models\Bundle;
use Illuminate\Database\Eloquent\Factories\Factory;

class BundleFactory extends Factory
{
    protected $model = Bundle::class;

    public function definition(): array
    {
        $durationUnit = $this->faker->randomElement(['day', 'week', 'month', 'year']);
        return [
            'name' => ucfirst($this->faker->words(2, true)) . ' Bundle',
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 500, 20000),
            'duration_unit' => $durationUnit,
            'duration' => $this->faker->numberBetween(1, 12),
            'is_active' => true,
            'is_recurring' => $this->faker->boolean(30),
            'trial_days' => $this->faker->numberBetween(0, 14),
            'type' => $this->faker->optional()->randomElement(['service', 'support', 'subscription']),
            'features' => $this->faker->randomElements(['Priority support', 'Consultation', 'Downloads', 'Updates', 'Reports'], 2),
        ];
    }
}
