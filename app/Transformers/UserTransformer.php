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
            'userIdentifier' => (string)$user->user_id,
            'fullname' => (string)$user->name,
            'isAdministrator' => ($user->admin === User::ADMIN_USER),
            'createdDate' => (string)$user->created_at,
            'changeDate' => (string)$user->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'userIdentifier' => 'user_id',
            'fullname' => 'name',
            'isAdministrator' => 'admin',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
