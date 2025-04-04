<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateBookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding bookings table
        DB::table('bookings')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'date' => '2025-04-10',
                'start_time' => '10:00:00',
                'end_time' => '12:00:00',
                'confirmed' => true
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'date' => '2025-04-11',
                'start_time' => '13:00:00',
                'end_time' => '15:00:00',
                'confirmed' => false
            ],
            [
                'id' => 3,
                'user_id' => 2,
                'date' => '2025-04-07',
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'confirmed' => true
            ],
            [
                'id' => 4,
                'user_id' => 1,
                'date' => '2025-04-08',
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'confirmed' => false
            ],
            [
                'id' => 5,
                'user_id' => 1,
                'date' => '2025-04-09',
                'start_time' => '14:00:00',
                'end_time' => '15:00:00',
                'confirmed' => true
            ],
        ]);
    }
}
