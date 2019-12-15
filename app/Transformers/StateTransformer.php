<?php

namespace App\Transformers;

use App\State;
use League\Fractal\TransformerAbstract;

class StateTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(State $state)
    {
        return [
            'stateIdentifier' => (string)$state->state_id,
            'stateName' => (string)$state->state,
            'createdDate' => (string)$title->created_at,
            'changeDate' => (string)$title->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'stateIdentifier' => 'state_id',
            'stateName' => 'state',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'state_id' => 'stateIdentifier',
            'state' => 'stateName',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
