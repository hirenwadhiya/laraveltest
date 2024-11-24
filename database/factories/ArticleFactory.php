<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => $title,
            'author' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'content' => $this->faker->paragraph(),
            'url' => $this->faker->url(),
            'image_url' => $this->faker->imageUrl(),
            'category_id' => Category::factory(),
            'source_id' => Source::factory(),
            'published_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
