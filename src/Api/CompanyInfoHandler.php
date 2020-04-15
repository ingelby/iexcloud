<?php

namespace Ingelby\Iexcloud\Api;

use Ingelby\Iexcloud\Exceptions\IexcloudRateLimitException;
use Ingelby\Iexcloud\Exceptions\IexcloudResponseException;
use Ingelby\Iexcloud\Models\CompanyInfo;
use ingelby\toolbox\constants\HttpStatus;
use ingelby\toolbox\services\InguzzleHandler;

class CompanyInfoHandler extends AbstractHandler
{

    /**
     * @param string $symbol
     * @return CompanyInfo
     * @throws IexcloudResponseException
     * @throws IexcloudRateLimitException
     */
    public function getInfo(string $symbol)
    {
        $response = $this->fetch(
            'company',
            $symbol
        );

        if (empty($response)) {
            throw new IexcloudResponseException(HttpStatus::NOT_FOUND, 'No company info for symbol: ' . $symbol);
        }

        $model = new CompanyInfo();
        $model->setAttributes($response);
        return $model;
    }
}

