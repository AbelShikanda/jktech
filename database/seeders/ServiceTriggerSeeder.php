<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTriggerSeeder extends Seeder
{
    public function run()
    {
        $driver = DB::getDriverName();

        if ($driver === 'mysql') {
            DB::unprepared('DROP TRIGGER IF EXISTS set_service_price_before_insert');
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
            return;
        }

        if ($driver === 'pgsql') {
            DB::unprepared('DROP TRIGGER IF EXISTS set_service_price_before_insert ON services');
            DB::unprepared('DROP FUNCTION IF EXISTS set_service_price_before_insert()');
            DB::unprepared(<<<'SQL'
CREATE OR REPLACE FUNCTION set_service_price_before_insert()
RETURNS trigger AS $$
DECLARE
    default_price NUMERIC(10,2);
BEGIN
    SELECT price INTO default_price
    FROM service_types
    WHERE id = NEW.type_id
    LIMIT 1;

    IF NEW.price IS NULL OR NEW.price = 0 THEN
        NEW.price := default_price;
    END IF;

    RETURN NEW;
END;
$$ LANGUAGE plpgsql;
SQL);
            DB::unprepared('
                CREATE TRIGGER set_service_price_before_insert
                BEFORE INSERT ON services
                FOR EACH ROW
                EXECUTE FUNCTION set_service_price_before_insert()
            ');
        }
    }
}
