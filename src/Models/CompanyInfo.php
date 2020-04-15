<?php


namespace Ingelby\Iexcloud\Models;


use yii\base\Model;

class CompanyInfo extends Model
{
    /**
     * @var string
     */
    public $symbol;
    /**
     * @var string
     * Name of the company
     */
    public $companyName;

    /**
     * @var number
     * Number of employees
     */
    public $employees;

    /**
     * @var string
     */
    public $exchange;

    /**
     * @var string
     */
    public $industry;

    /**
     * @var string
     */
    public $website;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $CEO;

    /**
     * @var string
     * Name of the security
     */
    public $securityName;

    /**
     * @var string
     * refers to the common issue type of the stock.
     */
    public $issueType;

    /**
     * @var string
     */
    public $sector;

    /**
     * @var string
     * Primary SIC Code for the symbol (if available)
     */
    public $primarySicCode;

    /**
     * @var array
     * an array of strings used to classify the company.
     */
    public $tags;

    /**
     * @var array
     * street address of the company if available
     */
    public $address;

    /**
     * @var array
     * street address of the company if available
     */
    public $address2;

    /**
     * @var array
     * state of the company if available
     */
    public $state;

    /**
     * @var array
     * city of the company if available
     */
    public $city;

    /**
     * @var array
     * zip of the company if available
     */
    public $zip;

    /**
     * @var array
     * country of the company if available
     */
    public $country;

    /**
     * @var array
     * phone number of the company if available
     */
    public $phone;


    /**
     * @return array
     */
    public function rules()
    {
        return [
            [
                [
                    'symbolol',
                    'companyName',
                    'employees',
                    'exchange',
                    'industry',
                    'website',
                    'description',
                    'CEO',
                    'securityName',
                    'issueType',
                    'sector',
                    'primarySicCode',
                    'tags',
                    'address',
                    'address2',
                    'state',
                    'city',
                    'zip',
                    'country',
                    'phone',
                ],
                'safe',
            ],
        ];
    }

}
