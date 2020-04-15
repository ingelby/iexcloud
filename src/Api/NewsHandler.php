<?php

namespace Ingelby\Iexcloud\Api;

use Ingelby\Iexcloud\Exceptions\IexcloudRateLimitException;
use Ingelby\Iexcloud\Exceptions\IexcloudResponseException;
use Ingelby\Iexcloud\Models\News;
use ingelby\toolbox\constants\HttpStatus;
use ingelby\toolbox\services\InguzzleHandler;
use Carbon\Carbon;

class NewsHandler extends AbstractHandler
{

    /**
     * @param string $symbol
     * @return Url
     * @throws IexcloudResponseException
     * @throws IexcloudRateLimitException
     */
    public function getNews(string $symbol)
    {
        $response = $this->fetch(
            'news',
			$symbol
        );

        $allNews = [];

		foreach ($response as $article) :
			$date = new \DateTime();
			$date->setTimestamp($article["datetime"/ 1000]);
			$formattedTime = Carbon::parse($date)->diffForHumans();
			$article['formattedTime'] = $formattedTime;
			array_push($allNews, $article);
		endforeach;

        return $allNews;
    }
}

