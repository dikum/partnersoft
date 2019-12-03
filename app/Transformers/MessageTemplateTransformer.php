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
            'messageTemplateIdentifier' => (string)$message->message_template_id,
            'messageTitle' => (string)$message->title,
            'messageTemplate' => (string)$message->message,
            'createdDate' => (string)$message->created_at,
            'changeDate' => (string)$message->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'messageTemplateIdentifier' => 'message_template_id',
            'messageTitle' => 'title',
            'messageTemplate' => 'message',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
