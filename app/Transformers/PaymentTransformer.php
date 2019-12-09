<?php

namespace App\Transformers;

use App\Payment;
use League\Fractal\TransformerAbstract;

class PaymentTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Payment $payment)
    {
        return [
            'paymentIdentifier' => (string)$payment->payment_id,
            'partnerIdentifier' => (string)$payment->partner_id,
            'bankStatementIdentifier' => (string)$payment->bank_statment_id,
            'userIdentifier' => (string)$payment->user_id,
            'createdDate' => (string)$payment->created_at,
            'changeDate' => (string)$payment->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('payments.show', $payment->payment_id),
                ],
                [
                    'rel' => 'payments.bankstatements',
                    'href' => route('payments.bankstatements.index', $payment->payment_id),
                ], 
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'paymentIdentifier' => 'payment_id',
            'partnerIdentifier' => 'partner_id',
            'bankStatementIdentifier' => 'bank_statement_id',
            'userIdentifier' => 'user_id',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
