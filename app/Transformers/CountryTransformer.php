<?php

namespace App\Transformers;

use App\Country;
use League\Fractal\TransformerAbstract;

class CountryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Country $country)
    {
        return [
            'countryIdentifier' => (int)$country->id,
            'continentIdentifier' => (int)$country->continent_id,
            'countryName' => (string)$country->country,
            'countryDialingCode' => (string)$country->dial_code,
            'countryShortName' => (string)$country->country_code,
            'createdDate' => $country->created_at,
            'changeDate' => $country->updated_at,
        ];
    }
}
