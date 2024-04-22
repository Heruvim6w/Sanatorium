<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\About;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Category::factory()->create([
             'title' => 'Новости',
             'description' => 'Новости из жизни нашего СНТ',
             'image' => fake()->imageUrl(640, 480),
             'slug' => 'news',
         ]);

         Category::factory()->create([
             'title' => 'Объявления',
             'description' => 'Объявления нашего СНТ',
             'image' => fake()->imageUrl(640, 480),
             'slug' => 'ads',
         ]);

         Category::factory()->create([
             'title' => 'Общие собрания',
             'slug' => 'general_meetings',
         ]);

         Category::factory()->create([
             'title' => 'Садоводам СНТ',
             'slug' => 'for_gardeners',
         ]);

         About::factory()->create();
    }
}
