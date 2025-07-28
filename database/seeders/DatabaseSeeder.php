<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use CreateServicesTable;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // Users
            CreateAdminSeeder::class,
            CreateUserSeeder::class,
        ]);
        $this->call([
            // Categories and Types
            ServiceCategoriesSeeder::class,
            ServiceTypeSeeder::class,
            KnowledgeBaseCategorySeeder::class,
        ]);
        $this->call([
            // Attributes
            CreateHolidaysSeeder::class,
            CreateWorkingHoursSeeder::class,
            FaqsSeeder::class,
        ]);
        $this->call([
            // Products
            CreateBookingsSeeder::class,
            CreateServicesSeeder::class,
            KnowledgeBaseSeeder::class,
            BundleSeeder::class,
            // SoftwareSeeder::class,
        ]);
        $this->call([
            // pivots
            CreatePIvotSeeder::class,
            KnowledgeKnowledgeBaseCategorySeeder::class,
        ]);
        $this->call([
            // seeders
            ServiceTriggerSeeder::class,
        ]);
    }
}
