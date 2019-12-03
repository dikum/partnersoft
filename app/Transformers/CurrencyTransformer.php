<?php

namespace App\Transformers;

use App\Currency;
use League\Fractal\TransformerAbstract;

class CurrencyTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Currency $currency)
    {
        return [
            'currencyIdentifier' => (string)$currency->currency_id,
            'currencyName' => (string)$currency->currency,
            'currencyShortName' => (string)$currency->currency_code,
            'minimumAmount' => (string)$currency->minimum_amount,
            'createdDate' => (string)$currency->created_at,
            'changeDate' => (string)$currency->updated_at,
        ];
    }


    public static function originalAttribute($index)
    {
        $attributes = [

            'currencyIdentifier' => 'currency_id',
            'currencyName' => 'currency',
            'currencyShortName' => 'currency_code',
            'minimumAmount' => 'minimum_amount',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
