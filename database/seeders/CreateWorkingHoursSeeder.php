<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateWorkingHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding working_hours table
        DB::table('working_hours')->insert([
            ['day_of_week' => 'Monday', 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'is_off_day' => false],
            ['day_of_week' => 'Tuesday', 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'is_off_day' => false],
            ['day_of_week' => 'Wednesday', 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'is_off_day' => false],
            ['day_of_week' => 'Thursday', 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'is_off_day' => false],
            ['day_of_week' => 'Friday', 'start_time' => '09:00:00', 'end_time' => '17:00:00', 'is_off_day' => false],
            ['day_of_week' => 'Saturday', 'start_time' => '10:00:00', 'end_time' => '14:00:00', 'is_off_day' => true],
            ['day_of_week' => 'Sunday', 'start_time' => '00:00:00', 'end_time' => '00:00:00', 'is_off_day' => true],
        ]);
    }
}
