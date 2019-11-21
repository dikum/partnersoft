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
            'commentIdentifier' => (int)$comment->id,
            'partnerIdentifier' => (int)$comment->partner_id,
            'userIdentifier' => (int)$comment->user_id,
            'commentBody' => (string)$comment->comment,
            'createdDate' => $comment->created_at,
            'changeDate' => $comment->updated_at,
        ];
    }
}
