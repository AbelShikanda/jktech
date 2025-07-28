<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceTypeSeeder extends Seeder
{
    public function run()
    {
        $serviceTypes = [
            ['Data Analytics and Reporting', 100000],
            ['Document Management Systems', 120000],
            ['Consulting', 2000],
            ['E-commerce Dashboarding', 110000],
            ['E-commerce', 150000],
            ['Portfolio', 50000],
            ['Non Profit', 70000],
            ['Business', 90000],
            ['Blog', 40000],
            ['Forum/cummunity', 85000],
            ['Education', 100000],
            ['Content Marketing', 95000],
            ['Point Of Sale', 130000],
            ['Website Maintanance', 30000],
            ['Mobile Application Maintanance', 35000],
            ['Systems and Software Maintanance', 40000],
        ];

        foreach ($serviceTypes as [$name, $price]) {
            DB::table('service_types')->insert([
                'name' => $name,
                'slug' => Str::slug($name),
                'price' => $price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
