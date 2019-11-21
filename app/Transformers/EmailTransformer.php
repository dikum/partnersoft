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
            'userIdentifier' => (int)$email->id,
            'partnerIdentifier' => (int)$email->partner_id,
            'enteredByUser' => (int)$email->user_id,
            'fromEmail' => (string)$email->sender,
            'toEmail' => (string)$email->recipient,
            'emailSubject'=>(string)$email->subject,
            'messageBody' => (string)$email->message,
            'messageStatus' => (string)$email->status,
            'createdDate' => $email->created_at,
            'changeDate' => $email->updated_at,
        ];
    }
}
