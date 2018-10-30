<?php

namespace App\Models\NavigationBar\Service;

use App\Models\NavigationBar\NavigationBar;
use App\Models\NavigationBar\NavigationBarSetting;
use App\Services\RabbitFinanceBlogService;

class NavigationBarFactory
{
    /** @var RabbitFinanceBlogService */
    private $blogService;
    public function __construct(RabbitFinanceBlogService $rabbitFinanceBlogService)
    {
        $this->blogService = $rabbitFinanceBlogService;
    }
    /**
     * Factory NavigationBar entity
     *
     * @param NavigationBarSetting $setting
     *
     * @return NavigationBar
     */
    public function fromSetting(NavigationBarSetting $setting)
    {
        $navigationBarData = $setting['items'];
        $relatedArticleAmount = $setting['related_article_amount'];
        foreach ($navigationBarData as &$item) {
            if ($item['related_article_id'] !== null) {
                foreach ($item['related_article_id'] as $lang => $id) {
                    $order                           = 1;
                    $responses                       = $this->blogService->getRecentArticles($id, $relatedArticleAmount);
                    $item['related_articles'][$lang] = [];
                    foreach ($responses as $relatedArticle) {
                        $item['related_articles'][$lang][] = [
                            'order' => $order++,
                            'title' => $relatedArticle['title']['rendered'],
                            'link' => $relatedArticle['link']
                        ];
                    }
                }
            }
            unset($item['related_article_id']);
        }
        $navigationBar      = new NavigationBar();
        $navigationBar->id  = 1;
        $navigationBar->bar = $navigationBarData;
        return $navigationBar;
    }
}
