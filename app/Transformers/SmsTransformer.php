<?php

namespace App\Transformers;

use App\Sms;
use League\Fractal\TransformerAbstract;

class SmsTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Sms $sms)
    {
        return [
            'smsIdentifier' => (string)$sms->sms_id,
            'partnerIdentifier' => (int)$sms->partner_id,
            'enteredByUser' => (int)$sms->user_id,
            'fromNumber' => (string)$sms->sender,
            'toNumber' => (string)$sms->recipient,
            'messageBody' => (string)$sms->message,
            'messageStatus' => (string)$sms->status,
            'createdDate' => (string)$sms->created_at,
            'changeDate' => (string)$sms->updated_at,
        ];
    }
}