<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KnowledgeBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = [
            [
                'id' => 1,
                'category_id' => 1,
                'title' => 'Introduction to AI',
                'sub_title' => 'Understanding the basics of Artificial Intelligence',
                'body' => 'Artificial Intelligence (AI) is the simulation of human intelligence in machines...',
            ],
            [
                'id' => 2,
                'category_id' => 2,
                'title' => 'How to Start a Business',
                'sub_title' => 'Key steps to starting a successful business',
                'body' => 'Starting a business requires planning, market research, and financial decision-making...',
            ],
            [
                'id' => 3,
                'category_id' => 3,
                'title' => 'Social Media Marketing Strategies',
                'sub_title' => 'Boost your brand visibility with social media',
                'body' => 'Social media marketing involves using platforms like Facebook, Instagram, and Twitter...',
            ],
            [
                'id' => 4,
                'category_id' => 4,
                'title' => 'Managing Personal Finances',
                'sub_title' => 'Tips to control your financial health',
                'body' => 'Managing personal finances requires budgeting, saving, and investing wisely...',
            ],
            [
                'id' => 5,
                'category_id' => 5,
                'title' => 'Healthy Eating Habits',
                'sub_title' => 'The importance of balanced nutrition',
                'body' => 'Eating a balanced diet ensures your body receives essential nutrients for growth...',
            ],
        ];

        foreach ($articles as $article) {
            DB::table('knowledge_bases')->insert([
                'knowledgeBase_categories_id' => $article['category_id'],
                'title' => $article['title'],
                'sub_title' => $article['sub_title'],
                'body' => $article['body'],
                'slug' => Str::slug($article['title']),
                'meta_title' => $article['title'],
                'meta_description' => substr($article['body'], 0, 150),
                'meta_keywords' => 'knowledge, ' . strtolower($article['title']),
                'meta_image' => null,
                'whatsapp' => 1,
                'telegram' => 0,
                'website' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
