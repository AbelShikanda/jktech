<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateAdminSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        $admins = [
            [
                'id' => 5,
                'uuid' => 'e7ed7f10-7e8e-43f5-af31-ee6dfa65eb49',
                'username' => 'abel',
                'name' => 'abel',
                'avatar' => null,
                'email' => 'abelshikanda3@gmail.com',
                'password' => '$2y$10$3LYZlEfKFA4xzo84LPmtHuqDHxWIEcEeMqFNho/FXlLFFOs14aE1a',
                'is_admin' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'uuid' => 'e7ed7f10-7e8e-48f5-af31-ee6dfa65fb49',
                'username' => 'fiona',
                'name' => 'fiona',
                'avatar' => null,
                'email' => 'liszt.luca2@gmail.com',
                'password' => '$2y$10$3LYZlEfKFA4xzo84LPmtHuqDHxWIEcEeMqFNho/FXlLFFOs14aE1a',
                'is_admin' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($admins as $admin) {
            if (!DB::table('admins')->where('email', $admin['email'])->exists()) {
                $admin['uuid'] = $admin['uuid'] ?: (string) Str::uuid();
                DB::table('admins')->insert($admin);
            }
        }
    }
}
