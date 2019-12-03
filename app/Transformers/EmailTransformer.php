<?php

namespace App\Transformers;

use App\Email;
use League\Fractal\TransformerAbstract;

class EmailTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Email $email)
    {
        return [
            'emailIdentifier' => (string)$email->email_id,
            'partnerIdentifier' => (string)$email->partner_id,
            'enteredByUser' => (string)$email->user_id,
            'fromEmail' => (string)$email->sender,
            'toEmail' => (string)$email->recipient,
            'emailSubject'=>(string)$email->subject,
            'messageBody' => (string)$email->message,
            'messageStatus' => (string)$email->status,
            'createdDate' => (string)$email->created_at,
            'changeDate' => (string)$email->updated_at,
        ];
    }


    public static function originalAttribute($index)
    {
        $attributes = [

            'emailIdentifier' => 'email_id',
            'partnerIdentifier' => 'partner_id',
            'enteredByUser' => 'user_id',
            'fromEmail' => 'sender',
            'toEmail' => 'recipient',
            'emailSubject'=> 'subject',
            'messageBody' => 'message',
            'messageStatus' => 'status',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
