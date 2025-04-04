<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'id' => 1,
                'categories_id' => 11,
                'type_id' => 3,
                'price' => 2000.0,
                'name' => 'Business Consultation',
                'slug' => Str::slug('Business Consultation'),
                'description' => 'Expert business advice to help you grow and optimize operations.',
                'meta_title' => 'Business Consultation Services',
                'meta_description' => 'Get expert business consultation services for your startup or enterprise.',
                'meta_keywords' => 'business, consultation, growth, strategy',
                'meta_image' => null,
                'whatsapp' => 1,
                'telegram' => 1,
                'website' => 1,
                'promotion' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'categories_id' => 6,
                'type_id' => 6,
                'price' => 42990.0,
                'name' => 'Personal/Portfolio Web Development',
                'slug' => Str::slug('Personal Portfolio Web Development'),
                'description' => 'Build a stunning personal portfolio or resume website.',
                'meta_title' => 'Personal Portfolio Web Development',
                'meta_description' => 'Create a professional personal website to showcase your work.',
                'meta_keywords' => 'portfolio, personal website, web development',
                'meta_image' => null,
                'whatsapp' => 1,
                'telegram' => 1,
                'website' => 1,
                'promotion' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'categories_id' => 6,
                'type_id' => 5,
                'price' => 80599.0,
                'name' => 'E-commerce Web Development',
                'slug' => Str::slug('E-commerce Web Development'),
                'description' => 'Develop a full-featured online store with payment integrations.',
                'meta_title' => 'E-commerce Web Development Services',
                'meta_description' => 'Start selling online with a custom-built e-commerce website.',
                'meta_keywords' => 'e-commerce, online store, shop, web development',
                'meta_image' => null,
                'whatsapp' => 1,
                'telegram' => 1,
                'website' => 1,
                'promotion' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'categories_id' => 10,
                'type_id' => 12,
                'price' => 35599.0,
                'name' => 'Content Marketing Strategies',
                'slug' => Str::slug('Content Marketing Strategies'),
                'description' => 'Effective content marketing strategies to boost engagement and sales.',
                'meta_title' => 'Content Marketing Strategies',
                'meta_description' => 'Grow your brand with expert content marketing strategies.',
                'meta_keywords' => 'content marketing, digital marketing, SEO',
                'meta_image' => null,
                'whatsapp' => 1,
                'telegram' => 1,
                'website' => 1,
                'promotion' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'categories_id' => 6,
                'type_id' => 8,
                'price' => 56750.0,
                'name' => 'Business Web Development',
                'slug' => Str::slug('Business Web Development'),
                'description' => 'Develop a business website to establish a strong online presence.',
                'meta_title' => 'Business Web Development Services',
                'meta_description' => 'Build a professional business website with advanced features.',
                'meta_keywords' => 'business website, corporate web development',
                'meta_image' => null,
                'whatsapp' => 1,
                'telegram' => 1,
                'website' => 1,
                'promotion' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
