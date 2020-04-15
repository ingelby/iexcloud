<?php


namespace Ingelby\Iexcloud\Models;

use Carbon\Carbon;
use yii\base\Model;

class IexCloudNews extends Model
{

	/**
	 * @var string
	 */
	public $symbol;

	/**
	 * @var integer
	 * Millisecond epoch of time of article
	 */
	public $datetime;

	/**
	 * @var string
	 */
	public $headline;

	/**
	 * @var string
	 * Source of the news article. Make sure to always attribute the source.
	 */
	public $source;

	/**
	 * @var string
	 * URL to IEX Cloud for associated news image. Note: You will need to append your token before calling.
	 */
	public $url;

	/**
	 * @var string
	 */
	public $summary;

	/**
	 * @var string
	 * Comma-delimited list of tickers associated with this news article. Not all tickers are available on the API. Make sure to check against available ref-data
	 */
	public $related;

	/**
	 * @var string
	 * URL to IEX Cloud for associated news image. Note: You will need to append your token before calling.
	 */
	public $image;

	/**
	 * @var string
	 * Language of the source article
	 */
	public $lang;

	/**
	 * @var boolean
	 * Whether the news source has a paywall
	 */
	public $hasPaywall;


	/**
	 * @return array
	 */
	public function rules()
	{
		return [
			[
				[
					'symbol',
					'datetime',
					'headline',
					'source',
					'url',
					'summary',
					'related',
					'image',
					'lang',
					'hasPaywall',
				],
				'safe',
			],
		];
	}

    /**
     * @return string
     */
	public function getFormatDateSincePublication()
    {
        return Carbon::createFromTimestampMs($this->datetime)->diffForHumans();
    }

}
