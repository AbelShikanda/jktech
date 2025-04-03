<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceTypes = [
            'Data Analytics and Reporting',
            'Document Management Systems',
            'Consulting',
            'E-commerce Dashboarding',
            'E-commerce',
            'Portfolio',
            'Non Profit',
            'Business',
            'Blog',
            'Forum/cummunity',
            'Education',
            'Content Marketing',
            'Point Of Sale',
            'Website Maintanance',
            'Mobile Application Maintanance',
            'Systems and Software Maintanance',
        ];

        foreach ($serviceTypes as $service) {
            DB::table('service_types')->insert([
                'name' => $service,
                'slug' => Str::slug($service),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
