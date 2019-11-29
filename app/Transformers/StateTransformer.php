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
            'stateIdentifier' => (int)$state->id,
            'stateName' => (string)$state->state,
            'createdDate' => $title->created_at,
            'changeDate' => $title->updated_at,
        ];
    }
}
