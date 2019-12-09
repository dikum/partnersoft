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

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->user_id),
                ],
                [
                    'rel' => 'users.payments',
                    'href' => route('users.payments.index', $user->user_id),
                ],
                [
                    'rel' => 'users.comments',
                    'href' => route('users.comments.index', $user->user_id),
                ],
                [
                    'rel' => 'users.partners',
                    'href' => route('users.partners.index', $user->user_id),
                ], [
                    'rel' => 'users.messages',
                    'href' => route('users.messages.index', $user->user_id),
                ],
            ],
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
