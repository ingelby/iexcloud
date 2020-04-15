<?php

namespace Ingelby\Iexcloud\Api;

use Ingelby\Iexcloud\Exceptions\IexcloudRateLimitException;
use Ingelby\Iexcloud\Exceptions\IexcloudResponseException;
use Ingelby\Iexcloud\Models\StockLogo;
use ingelby\toolbox\constants\HttpStatus;
use ingelby\toolbox\services\InguzzleHandler;

class StockLogoHandler extends AbstractHandler
{

    /**
     * @param string $symbol
     * @return Url
     * @throws IexcloudResponseException
     * @throws IexcloudRateLimitException
     */
    public function getLogo(string $symbol)
    {
        $response = $this->fetch(
            'logo',
			$symbol
        );


        $response =  $response['url'];

        return $response;
    }
}









