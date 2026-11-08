<?php

namespace Database\Factories;

use App\Models\Faqs;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqsFactory extends Factory
{
    protected $model = Faqs::class;

    public function definition(): array
    {
        return [
            'question' => rtrim($this->faker->sentence(), '.') . '?',
            'answer' => $this->faker->paragraph(),
            'is_active' => $this->faker->boolean(90),
        ];
    }
}
