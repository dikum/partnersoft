<?php

namespace App\Transformers;

use App\LastPartnerNumber;
use League\Fractal\TransformerAbstract;

class LastPartnerNumberTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(LastPartnerNumber $number)
    {
        return [
            'numberIdentifier' => (int)$number->id,
            'lastPartnerNumber' => (int)$number->last_number,
            'createdDate' => $number->created_at,
            'changeDate' => $number->updated_at,
        ];
    }
}
