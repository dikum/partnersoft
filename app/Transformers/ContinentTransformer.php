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
            'continentIdentifier' => (int)$continent->id,
            'continentName' => (string)$continent->continent,
            'continentShortName' => (string)$bank->continentCode,
            'createdDate' => $continent->created_at,
            'changeDate' => $continent->updated_at,
        ];
    }
}
