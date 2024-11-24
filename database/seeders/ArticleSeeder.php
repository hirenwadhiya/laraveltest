<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Source;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::factory()->count(20)->create([
            'category_id' => Category::factory()->create()->id,
            'source_id' => Source::factory()->create()->id,
        ]);
    }
}
