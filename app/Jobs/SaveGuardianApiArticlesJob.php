<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SaveGuardianApiArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct()
    {
    }

    public function handle(): void
    {
        $response = Http::get($this->guardianApiUrl())->json();

        $articles = $response['response']['results'];
        $source = Source::query()->firstOrCreate([
            'name' => 'Guardian',
        ], [
            'name' => 'Guardian',
        ]);
        $articleArray = [];
        foreach ($articles as $article) {
            $category = Category::query()->firstOrCreate([
                'name' => $article['sectionName'],
            ], [
                'name' => $article['sectionName'],
            ]);
            $articleArray[] = [
                'title' => $article['webTitle'],
                'slug'  => $article['webTitle'],
                'author'    => $article['author'] ?? 'Guardian Author',
                'description'   => $article['webTitle'],
                'content'   => $article['webTitle'],
                'url'   => $article['webUrl'],
                'image_url'   => $article['webUrl'],
                'published_at'   => $article['webPublicationDate'],
                'source_id' => $source->id,
                'category_id'   =>  $category->id,
            ];
        }
        $source->articles()->createMany($articleArray);
    }

    private function guardianApiUrl(): string
    {
        return sprintf(
            config('constants.api_urls.guardian_api'),
            config('constants.api_keys.guardian_api'),
            'football,health,news'
        );
    }
}
