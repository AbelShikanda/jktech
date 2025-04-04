<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceServiceImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding service_service_images table
        $serviceImages = DB::table('service_images')->pluck('id')->toArray();
        $services = DB::table('services')->pluck('id')->toArray();

        foreach ($serviceImages as $index => $imageId) {
            if (isset($services[$index])) {
                DB::table('service_service_images')->insert([
                    'services_id' => $services[$index],
                    'service_images_id' => $imageId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
