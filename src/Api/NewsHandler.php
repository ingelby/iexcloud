<?php

namespace Ingelby\Iexcloud\Api;

use Ingelby\Iexcloud\Exceptions\IexcloudRateLimitException;
use Ingelby\Iexcloud\Exceptions\IexcloudResponseException;
use Ingelby\Iexcloud\Models\News;
use ingelby\toolbox\constants\HttpStatus;
use ingelby\toolbox\services\InguzzleHandler;

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

        return $response;
    }
}
