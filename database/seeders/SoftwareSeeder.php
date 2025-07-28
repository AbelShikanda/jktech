<?php

namespace Database\Seeders;

use App\Models\Software;
use Illuminate\Database\Seeder;

class SoftwareSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Software::create([
            'name' => 'baktrak',
            'description' => 'A Kali Linux software for backing up files locally',
            'image' => 'storage/software/ai-assistant.png',
        ])->releases()->createMany([
            ['os' => 'linux', 'version' => '1.0.0', 'download_url' => 'https://example.com/linux.AppImage'],
        ]);

        Software::create([
            'name' => 'Abantu',
            'description' => 'A Whatsapp automation marketing tool',
            'image' => 'storage/software/ai-assistant.png',
        ])->releases()->createMany([
            ['os' => 'windows', 'version' => '1.0.0', 'download_url' => 'https://example.com/windows.exe'],
            ['os' => 'mac', 'version' => '1.0.0', 'download_url' => 'https://example.com/mac.dmg'],
            ['os' => 'linux', 'version' => '1.0.0', 'download_url' => 'https://example.com/linux.AppImage'],
        ]);
    }
}
