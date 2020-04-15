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
     * @return StockLogo
     * @throws IexcloudResponseException
     * @throws IexcloudRateLimitException
     */
    public function getLogo(string $symbol)
    {
        $response = $this->fetch(
            'logo',
            $symbol
        );

        if (empty($response)) {
            throw new IexcloudResponseException(HttpStatus::NOT_FOUND, 'No logo for symbol: ' . $symbol);
        }
        $model = new StockLogo();
        $model->setAttributes($response);
        return $model;
    }
}

