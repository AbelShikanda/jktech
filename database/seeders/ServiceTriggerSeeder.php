<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTriggerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Drop trigger if it exists to avoid duplication errors
        DB::unprepared('DROP TRIGGER IF EXISTS set_service_price_before_insert');

        // Create trigger
        DB::unprepared('
            CREATE TRIGGER set_service_price_before_insert
            BEFORE INSERT ON services
            FOR EACH ROW
            BEGIN
                DECLARE default_price DECIMAL(10,2);

                SELECT price INTO default_price
                FROM service_types
                WHERE id = NEW.type_id
                LIMIT 1;

                IF NEW.price IS NULL OR NEW.price = 0 THEN
                    SET NEW.price = default_price;
                END IF;
            END
        ');
    }
}
