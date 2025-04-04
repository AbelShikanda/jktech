<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeKnowledgeBaseImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seeding knowledge_knowledge_base_images table
        $knowledgeBaseImages = DB::table('knowledge_base_images')->pluck('id')->toArray();
        $knowledgeBases = DB::table('knowledge_bases')->pluck('id')->toArray();

        foreach ($knowledgeBaseImages as $index => $imageId) {
            if (isset($knowledgeBases[$index])) {
                DB::table('knowledge_knowledge_base_images')->insert([
                    'knowledgeBases_id' => $knowledgeBases[$index],
                    'knowledgeBase_images_id' => $imageId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
