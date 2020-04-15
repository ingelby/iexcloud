<?php

namespace Ingelby\Iexcloud\Api;

use Ingelby\Iexcloud\Exceptions\IexcloudRateLimitException;
use Ingelby\Iexcloud\Exceptions\IexcloudResponseException;
use Ingelby\Iexcloud\Models\IexCloudNews;
use ingelby\toolbox\constants\HttpStatus;
use ingelby\toolbox\services\InguzzleHandler;
use Carbon\Carbon;

class NewsHandler extends AbstractHandler
{

    /**
     * @param string $symbol
     * @return IexCloudNews[]
     * @throws IexcloudResponseException
     * @throws IexcloudRateLimitException
     */
    public function getNews(string $symbol)
    {
        $response = $this->fetch(
            'news',
            $symbol
        );

        $news = [];

        if (empty($response) || !is_array($response)) {
            throw new IexcloudResponseException(HttpStatus::NOT_FOUND, 'No news for symbol: ' . $symbol);
        }
        foreach ($response as $article) {
            $model = new IexCloudNews();
            $model->setAttributes($article);
            $news[] = $model;
        }

        return $news;
    }
}

