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
            'emailAddress' => (string)$user->email,
            'userType' => $user->type,
            'userBranch' => $user->branch,
            'isVerified' => (int)$user->verified,
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
            'emailAddress' => 'email',
            'userType' => 'type',
            'userBranch' => 'branch',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'user_id' => 'userIdentifier',
            'name' => 'fullname',
            'email' => 'emailAddress',
            'type' => 'userType',
            'branch' => 'userBranch',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
