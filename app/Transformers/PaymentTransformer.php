<?php

namespace App\Transformers;

use App\BankStatement;
use App\Http\Controllers\BankStatement\BankStatementController;
use App\Http\Controllers\Payment\PaymentBankStatementController;
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
        $paymentBankStatement = new PaymentBankStatementController();
        return [
            'paymentIdentifier' => (string)$payment->payment_id,
            'partnerIdentifier' => (string)$payment->made_by,
            'bankStatementIdentifier' => (string)$payment->bank_statement_id,
            'userIdentifier' => (string)$payment->entered_by,
            'createdDate' => (string)$payment->created_at,
            'changeDate' => (string)$payment->updated_at,
            'bank_statement' => $paymentBankStatement->index($payment),


            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('payments.show', $payment->payment_id),
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

    public static function transformedAttribute($index)
    {
        $attributes = [

            'payment_id' => 'paymentIdentifier',
            'partner_id' => 'partnerIdentifier',
            'bank_statement_id' => 'bankStatementIdentifier',
            'user_id' => 'userIdentifier',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
