<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateHolidaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding holidays table
        DB::table('holidays')->insert([
            ['date' => '2025-12-25', 'reason' => 'Christmas Day'],
            ['date' => '2025-01-01', 'reason' => 'New Year’s Day'],
        ]);
    }
}
