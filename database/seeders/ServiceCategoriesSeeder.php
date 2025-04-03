<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serviceCategories = [
            'Governance and Compliance',
            'Cloud',
            'AI',
            'Security',
            'BI Solutions',
            'Web Development',
            'Software Development',
            'Mobile Development',
            'Management Systems',
            'Marketing',
            'Consulting',
            'Analytics',
            'Dashboarding',
            'Maintanance Packages',
        ];

        foreach ($serviceCategories as $category) {
            DB::table('service_categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
