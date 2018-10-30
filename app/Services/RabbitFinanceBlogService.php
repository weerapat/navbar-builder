<?php

namespace App\Services;

use GuzzleHttp\Client;

class RabbitFinanceBlogService
{
    /** @var Client */
    private $client;

    /** @var string */
    private $rabbitBlogApiUrl;

    /** @var int */
    private $categoriesPerPage;

    /** @var string */
    private $latestRfArticlesApiUrl;

    /**
     * RabbitBlogService constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->rabbitBlogApiUrl       = config('rabbit_finance_blog.api-url');
        $this->categoriesPerPage      = config('rabbit_finance_blog.categories-per-page');
        $this->client                 = $client;
        $this->latestRfArticlesApiUrl = config('rabbit_finance_blog.latest-articles-url');
    }

    /**
     * Get articles from Rabbit Blog
     *
     * @param int $categoryId
     * @param int $numArticles
     *
     * @return array
     */
    public function getRecentArticles(int $categoryId, int $numArticles)
    {
        $response = $this->client->request(
            'GET',
            "{$this->rabbitBlogApiUrl}/posts",
            [
                'query' => [
                    'categories' => $categoryId,
                    'per_page' => $numArticles,
                    'order' => 'desc',
                    'orderBy' => 'date'
                ]
            ]
        );

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * @param string $slug
     *
     * @return mixed
     */
    public function getArticleBySlug(string $slug)
    {
        $response = $this->client->request(
            'GET',
            "{$this->rabbitBlogApiUrl}/posts?slug={$slug}"
        );

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * Get RF Blog Categories
     *
     * @return array
     */
    public function getCategories()
    {
        $response = $this->client->request(
            'GET',
            "{$this->rabbitBlogApiUrl}/categories?per_page={$this->categoriesPerPage}"
        );

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * Get RF Blog Tags filter by search term
     *
     * @param string $term
     *
     * @return array
     */
    public function getTagsByTerm($term)
    {
        $response = $this->client->request(
            'GET',
            "{$this->rabbitBlogApiUrl}/tags?search={$term}"
        );

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }

    /**
     * Get latest articles from Rabbit Finance Blog filter by given categories or tags
     *
     * @param string $categories For example 1,2,3,4,...
     * @param string $tags For example 1,2,3,4,...
     *
     * @return array
     */
    public function getLatestArticles($categories, $tags)
    {
        $response = $this->client->request(
            'GET',
            "{$this->latestRfArticlesApiUrl}?categories={$categories}&tags={$tags}"
        );

        return \GuzzleHttp\json_decode($response->getBody(), true);
    }
}
