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

    public static function originalAttribute($index)
    {
        $attributes = [

            'numberIdentifier' => 'last_partner_number_id',
            'lastPartnerNumber' => 'last_number',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'last_partner_number_id' => 'numberIdentifier',
            'last_number' => 'lastPartnerNumber',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
