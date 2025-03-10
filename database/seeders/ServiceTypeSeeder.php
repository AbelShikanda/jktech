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
            'Data Analytics',
            'Business Intelligence Consulting',
            'Enterprise Reporting & Dashboards',
            'Data Governance & Compliance',
            'Software Development',
            'Mobile Application Development',
            'Web Application Development',
            'Content Marketing Strategy',
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
