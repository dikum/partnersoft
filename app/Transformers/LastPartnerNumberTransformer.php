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
            'numberIdentifier' => (int)$number->last_partner_number_id,
            'lastPartnerNumber' => (int)$number->last_number,
            'createdDate' => (string)$number->created_at,
            'changeDate' => (string)$number->updated_at,
        ];
    }
}
