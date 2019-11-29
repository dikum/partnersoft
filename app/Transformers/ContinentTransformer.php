<?php

namespace App\Transformers;

use App\Continent;
use League\Fractal\TransformerAbstract;

class ContinentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Continent $continent)
    {
        return [
            'continentIdentifier' => (string)$continent->continent_id,
            'continentName' => (string)$continent->continent,
            'continentShortName' => (string)$bank->continentCode,
            'createdDate' => (string)$continent->created_at,
            'changeDate' => (string)$continent->updated_at,
        ];
    }
}
