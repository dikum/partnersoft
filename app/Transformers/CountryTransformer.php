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
            'countryIdentifier' => (string)$country->country_id,
            'continentIdentifier' => (string)$country->continent_id,
            'countryName' => (string)$country->country,
            'countryDialingCode' => (string)$country->dial_code,
            'countryShortName' => (string)$country->country_code,
            'createdDate' => (string)$country->created_at,
            'changeDate' => (string)$country->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'countryIdentifier' => 'country_id',
            'continentIdentifier' => 'continent_id',
            'countryName' => 'country',
            'countryDialingCode' => 'dial_code',
            'countryShortName' => 'country_code',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'country_id' => 'countryIdentifier',
            'continent_id' => 'continentIdentifier',
            'country' => 'countryName',
            'dial_code' => 'countryDialingCode',
            'country_code' => 'countryShortName',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
