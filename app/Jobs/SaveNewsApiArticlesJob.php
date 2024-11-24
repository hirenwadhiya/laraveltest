<?php

namespace App\Jobs;

use App\Models\Source;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SaveNewsApiArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public function __construct()
    {
    }

    public function handle(): void
    {
        $response = Http::get($this->newsApiUrl())->json();
        $articles = $response['articles'];
        foreach ($articles as $article) {

            $source = Source::query()->firstOrCreate([
                'name' => $article['source']['name'],
            ], ['name' => $article['source']['name']]);

            $source->articles()->create([
                'title' => $article['title'],
                'slug'  => $article['title'],
                'author'    => $article['author'],
                'description'   => $article['description'],
                'content'   => $article['content'],
                'url'   => $article['url'],
                'image_url'   => $article['urlToImage'],
                'published_at'   => $article['publishedAt'],
                'source_id' => $source->id
            ]);
        }
    }

    private function newsApiUrl(): string
    {
        return sprintf(
            config('constants.api_urls.news_api'),
            config('constants.api_keys.news_api'),
            'news'
        );
    }
}
