<?php

namespace Database\Seeders;

use App\Models\Bundle;
use Illuminate\Database\Seeder;

class BundleSeeder extends Seeder
{
    public function run()
    {
        Bundle::create([
            'name' => 'Weekly Unlimited',
            'description' => 'Gain a full week of marketing access',
            'price' => 100,
            'duration_unit' => 'week',
            'duration' => 1,
            'is_active' => true,
            'is_recurring' => true,
            'trial_days' => 2,
            'type' => 'Marketing Access',
            'features' => ['Unlimited Posts', 'Boosted Listings', 'Priority Support']  // ✅ FIXED
        ]);

        Bundle::create([
            'name' => 'Monthly Unlimited',
            'description' => 'Gain a full month of marketing access',
            'price' => 400,
            'duration_unit' => 'month',
            'duration' => 1,
            'is_active' => true,
            'is_recurring' => true,
            'trial_days' => 5,
            'type' => 'Marketing Access',
            'features' => ['Unlimited Posts', 'Analytics Dashboard', 'Priority Support']  // ✅ FIXED
        ]);
    }
}
