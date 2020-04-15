<?php


namespace Ingelby\Iexcloud\Helpers;


use Ingelby\Iexcloud\Models\SearchMatch;
use Ingelby\Iexcloud\Models\TimeSeries;

class Select2Helper
{

    /**
     * @param SearchMatch[] $searchResults
     * @return
     */
    public static function mapSimple(array $searchResults)
    {

        $mappedValues = [];
        foreach ($searchResults as $searchResult) {
            $mappedValues[] = [
                'id'   => $searchResult->symbol,
                'text' => $searchResult->getFriendlyName(),
            ];
        }
        return $mappedValues;
    }
}
