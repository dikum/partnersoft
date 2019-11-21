<?php

namespace App\Transformers;

use App\MessageTemplate;
use League\Fractal\TransformerAbstract;

class MessageTemplateTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(MessageTemplate $message)
    {
        return [
            'messageTemplateIdentifier' => (int)$message->id,
            'messageTitle' => (string)$message->title,
            'messageTemplate' => (string)$message->message,
            'createdDate' => $message->created_at,
            'changeDate' => $message->updated_at,
        ];
    }
}
