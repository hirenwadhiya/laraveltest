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
use Illuminate\Support\Str;

class SaveNYTimesApiArticlesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle(): void
    {
        $response = Http::get($this->newyorkTimesApiUrl())->json();
        $articles = $response['response']['docs'];

        foreach ($articles as $article) {

            $source = Source::query()->firstOrCreate([
                'name' => $article['source'],
            ], ['name' => $article['source']]);

            $category = Category::query()->firstOrCreate([
                'name' => $article['section_name'],
            ], [
                'name' => $article['section_name'],
            ]);

            $source->articles()->create([
                'title' => Str::limit($article['headline']['main'], 255),
                'slug'  => Str::limit($article['headline']['main'], 255),
                'author'    => $article['byline']['original'],
                'description'   => $article['lead_paragraph'],
                'content'   => $article['abstract'],
                'url'   => $article['web_url'],
                'image_url'   => $article['multimedia'][0]['url'] ?? null,
                'published_at'   => $article['pub_date'],
                'source_id' => $source->id,
                'category_id'   => $category->id,
            ]);
        }
    }

    private function newyorkTimesApiUrl(): string
    {
        return sprintf(
            config('constants.api_urls.newyork_times_api'),
            config('constants.api_keys.newyork_times_api'),
            'election,football,news,bitcoin'
        );
    }
}
