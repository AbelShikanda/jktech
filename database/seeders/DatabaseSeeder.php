<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

/**
 * Application seed orchestrator.
 *
 * PERMISSION-GATED: Do NOT run db:seed, migrate:fresh --seed, or any reseed
 * without explicit user permission. Some seeders may be destructive or assume
 * a fresh/local dataset. RolesAndPermissionsSeeder is intentionally NOT called
 * here; run it manually only with explicit permission.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
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
            // Products/content (SoftwareSeeder intentionally disabled until reviewed)
            CreateBookingsSeeder::class,
            CreateServicesSeeder::class,
            KnowledgeBaseSeeder::class,
            BundleSeeder::class,
        ]);
        $this->call([
            // Pivots
            CreatePIvotSeeder::class,
            KnowledgeKnowledgeBaseCategorySeeder::class,
        ]);
        $this->call([
            // DB helpers
            ServiceTriggerSeeder::class,
        ]);
    }
}
