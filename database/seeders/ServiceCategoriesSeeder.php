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
            'Analytics',
            'Cloud',
            'AI',
            'Security',
            'Web App',
            'BI Solutions',
            'Mobile App',
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
