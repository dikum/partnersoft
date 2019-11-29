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
}
