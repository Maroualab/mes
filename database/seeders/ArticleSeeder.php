<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      // Seed Articles
    $articles = Article::factory(10)->create();

    // Seed Tags
    $tags = Tag::factory(5)->create();

    // Attach tags to articles (example: randomly assign 2 tags to each article)
    foreach ($articles as $article) {
        $article->tags()->attach(
            $tags->random(2)->pluck('id')->toArray()  // Attach 2 random tags to each article
        );
    }
        
    }
}
