<?php

return [
    /*
     * Url to Rabbit Finance Blog Api
     */
    'api-url' => env('RABBIT_FINANCE_BLOG_API') . '/wp-json/wp/v2',
    'site-url' => env('RABBIT_FINANCE_BLOG_URI') . '/blog/',
    'latest-articles-url' => env('RABBIT_FINANCE_BLOG_API') . '/wp-json/rabbit-latest-posts/v1/posts',
    'categories-per-page' => 100,
];
