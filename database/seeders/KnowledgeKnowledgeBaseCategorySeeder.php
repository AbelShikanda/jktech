<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KnowledgeKnowledgeBaseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('knowledge_knowledge_base_categories')->insert([
            ['knowledgeBases_id' => 1, 'kBase_categories_id' => 1],
            ['knowledgeBases_id' => 2, 'kBase_categories_id' => 2],
            ['knowledgeBases_id' => 3, 'kBase_categories_id' => 3],
            ['knowledgeBases_id' => 4, 'kBase_categories_id' => 4],
            ['knowledgeBases_id' => 5, 'kBase_categories_id' => 5],
        ]);
    }
}
