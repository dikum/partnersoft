<?php

namespace App\Transformers;

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
            'currencyIdentifier' => $currency->id,
            'currencyName' => $currency->currency,
            'currencyShortName' => $currency->currency_code,
            'minimumAmount' => $currency->minimum_amount,
        ];
    }
}
