<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePIvotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding service_service_types table
        DB::table('service_service_types')->insert([
            ['services_id' => 1, 'service_types_id' => 3],
            ['services_id' => 2, 'service_types_id' => 6],
            ['services_id' => 3, 'service_types_id' => 5],
            ['services_id' => 4, 'service_types_id' => 12],
            ['services_id' => 5, 'service_types_id' => 8],
        ]);

        // Seeding service_service_categories table
        DB::table('service_service_categories')->insert([
            ['services_id' => 1, 'service_categories_id' => 11],
            ['services_id' => 2, 'service_categories_id' => 6],
            ['services_id' => 3, 'service_categories_id' => 6],
            ['services_id' => 4, 'service_categories_id' => 10],
            ['services_id' => 5, 'service_categories_id' => 6],
        ]);

        // Seeding booking_services table
        DB::table('booking_services')->insert([
            ['bookings_id' => 1, 'services_id' => 1],
            ['bookings_id' => 2, 'services_id' => 2],
            ['bookings_id' => 3, 'services_id' => 3],
            ['bookings_id' => 4, 'services_id' => 4],
            ['bookings_id' => 5, 'services_id' => 5],
        ]);
    }
}
