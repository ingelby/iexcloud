<?php

namespace Ingelby\Iexcloud\Api;

use common\helpers\LoggingHelper;
use Ingelby\Iexcloud\Exceptions\IexcloudRateLimitException;
use Ingelby\Iexcloud\Exceptions\IexcloudResponseException;
use ingelby\toolbox\constants\HttpStatus;
use ingelby\toolbox\services\inguzzle\exceptions\InguzzleClientException;
use ingelby\toolbox\services\inguzzle\exceptions\InguzzleInternalServerException;
use ingelby\toolbox\services\inguzzle\exceptions\InguzzleServerException;
use ingelby\toolbox\services\inguzzle\InguzzleHandler;
use yii\caching\TagDependency;
use yii\helpers\Json;

class AbstractHandler extends InguzzleHandler
{
    protected const DEFAULT_URL = 'https://cloud.iexapis.com/';
    protected const CACHE_KEY = 'IEXCLOUD_';
    protected const CACHE_TAG_DEPENDANCY = 'IEXCLOUD';
	protected const API_VERSION = 'stable';

    /**
     * @var string
     */
    protected $baseUrl;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var int
     */
    protected $cacheTimeout = 1800; # cached for 30 minutes

    /**
     * AbstractHandler constructor.
     *
     * @param string      $apiKey
     * @param string|null $baseUrl
     */
    public function __construct(string $token, $baseUrl = null)
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;

        if (null === $this->baseUrl) {
            $this->baseUrl = static::DEFAULT_URL.static::API_VERSION.'/';
        }

        parent::__construct($this->baseUrl);
    }

    /**
	 * @param string $call
     * @param array  $headers
     * @throws IexcloudResponseException
     * @throws IexcloudRateLimitException
     */
    public function fetch(string $call, string $symbol, array $headers = [])
    {
        $standardHeaders = [
            'token'   => $this->token
        ];
        $finalHeaders = array_merge($standardHeaders, $headers);

        $cacheKey = static::CACHE_KEY . $call . $symbol . md5(Json::encode($finalHeaders));

        return \Yii::$app->cache->getOrSet(
            $cacheKey,
            function () use ($finalHeaders,$symbol,$call) {
                try {
                    return $this->get("stock/$symbol/$call", $finalHeaders);
				} catch (InguzzleClientException $e) { //# https://iexcloud.io/docs/api/#error-codes
					LoggingHelper::logError($e);
                } catch (InguzzleInternalServerException | InguzzleServerException $e) {
					throw new IexcloudResponseException($e->statusCode, 'Error contacting IEX Cloud', 0, $e);
                }
            },
            $this->cacheTimeout,
            new TagDependency(['tags' => static::CACHE_TAG_DEPENDANCY])
        );
    }

    /**
     * @param int $cahceTimeout
     */
    public function setCacheTimeout(int $cacheTimeout)
    {
        $this->cacheTimeout = $cacheTimeout;
    }
}
