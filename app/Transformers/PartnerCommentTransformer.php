<?php

namespace App\Transformers;

use App\PartnerComment;
use League\Fractal\TransformerAbstract;

class PartnerCommentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(PartnerComment $comment)
    {
        return [
            'commentIdentifier' => (string)$comment->comment_id,
            'partnerIdentifier' => (string)$comment->partner_id,
            'userIdentifier' => (string)$comment->user_id,
            'commentBody' => (string)$comment->comment,
            'createdDate' => (string)$comment->created_at,
            'changeDate' => (string)$comment->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'commentIdentifier' => 'comment_id',
            'partnerIdentifier' => 'partner_id',
            'userIdentifier' => 'user_id',
            'commentBody' => 'comment',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'comment_id' => 'commentIdentifier',
            'partner_id' => 'partnerIdentifier',
            'user_id' => 'userIdentifier',
            'comment' => 'commentBody',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
