<?php

return [
    'api_urls'   =>  [
        'news_api' => 'https://newsapi.org/v2/everything?apiKey=%s&q=%s&sortBy=publishedAt',
        'guardian_api' => 'https://content.guardianapis.com/search?api-key=%s&q=%s',
        'newyork_times_api' => 'https://api.nytimes.com/svc/search/v2/articlesearch.json?api-key=%s&q=%s',
    ],
    'api_keys'   =>  [
        'news_api' => env('NEWSAPI_API_KEY', ''),
        'guardian_api' => env('GUARDIAN_API_KEY', ''),
        'newyork_times_api' => env('NYTIMES_API_KEY', ''),
    ]
];
