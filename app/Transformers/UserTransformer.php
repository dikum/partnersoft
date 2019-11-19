<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'userIdentifier' => (int)$user->id,
            'fullname' => (string)$user->name,
            'isAdministrator' => ($user->admin === User::ADMIN_USER),
            'createdDate' => $user->created_at,
            'changeDate' => $user->updated_at,
        ];
    }
}
