<?php


namespace Ingelby\Iexcloud\Models;


use yii\base\Model;

class StockLogo extends Model
{

    /**
     * @var string
     */
    public $symbol;

	/**
	 * @var string
	 * URL to IEX Cloud for associated news image. Note: You will need to append your token before calling.
	 */
	public $url;


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [
                [
                    'symbol',
                    'url',
                ],
                'safe',
            ],
        ];
    }

}
