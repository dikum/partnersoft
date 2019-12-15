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
            'partnerIdentifier' => (string)$sms->partner_id,
            'enteredByUser' => (string)$sms->user_id,
            'fromNumber' => (string)$sms->sender,
            'toNumber' => (string)$sms->recipient,
            'messageBody' => (string)$sms->message,
            'messageStatus' => (string)$sms->status,
            'createdDate' => (string)$sms->created_at,
            'changeDate' => (string)$sms->updated_at,
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'smsIdentifier' => 'sms_id',
            'partnerIdentifier' => 'partner_id',
            'enteredByUser' => 'user_id',
            'fromNumber' => 'sender',
            'toNumber' => 'recipient',
            'messageBody' => 'message',
            'messageStatus' => 'status',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'sms_id' => 'smsIdentifier',
            'partner_id' => 'partnerIdentifier',
            'user_id' => 'enteredByUser',
            'sender' => 'fromNumber',
            'recipient' => 'toNumber',
            'message' => 'messageBody',
            'status' => 'messageStatus',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }    
}
