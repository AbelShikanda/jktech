<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'uuid' => Str::uuid(),
                'first_name' => 'Abel',
                'last_name' => 'Shikanda',
                'email' => 'abelshikanda3@gmail.com',
                'gender' => null,
                'phone' => null,
                'town' => null,
                'location' => null,
                'terms_and_conditions' => false,
                'email_verified_at' => null,
                'password' => Hash::make('Qwerty123.'),
                'remember_token' => null,
                'created_at' => '2025-04-02 22:26:53',
                'updated_at' => '2025-04-02 22:26:53',
            ],
            [
                'id' => 2,
                'uuid' => Str::uuid(),
                'first_name' => 'Fiona',
                'last_name' => 'Muva',
                'email' => 'fiona.muva@example.com',
                'gender' => null,
                'phone' => null,
                'town' => null,
                'location' => null,
                'terms_and_conditions' => false,
                'email_verified_at' => null,
                'password' => Hash::make('Qwerty123.'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
