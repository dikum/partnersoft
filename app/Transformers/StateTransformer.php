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
}
