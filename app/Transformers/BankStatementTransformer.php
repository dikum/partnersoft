<?php

namespace App\Transformers;

use App\BankStatement;
use League\Fractal\TransformerAbstract;

class BankStatementTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(BankStatement $bank_statement)
    {
         return [
            'bankStatementIdentifier' => (string)$bank_statement->bank_statement_id,
            'transactionIdentifier' => (string)$bank_statement->transaction_id,
            'currencyIdentifier' => (string)$bank_statement->currency_id,
            'partnerIdentifier' => (string)$bank_statement->partner_id,
            'depositorName' => (string)$bank_statement->depositor,
            'paymentDescription' => (string)$bank_statement->description,
            'amountPaid' => (string)$bank_statement->amount,
            'datePaid' => (string)$bank_statement->payment_date,
            'valueDate' => (string)$bank_statement->value_date,
            'payment_method' => (string)$bank_statement->payment_channel,
            'payerEmail' => (string)$bank_statement->email,
            'payerPhone' => (string)$bank_statement->phone,
            'createdDate' => (string)$bank_statement->created_at,
            'changedDate' => (string)$bank_statement->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('bankstatements.show', $bank_statement->bank_statement_id),
                ],
                [
                    'rel' => 'bankstatements.payment',
                    'href' => route('bankstatements.payment.index', $bank_statement->bank_statement_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'bankStatementIdentifier' => 'bank_statement_id',
            'transactionIdentifier' => 'transaction_id',
            'currencyIdentifier' => 'currency_id',
            'partnerIdentifier' => 'partner_id',
            'depositorName' => 'depositor',
            'paymentDescription' => 'description',
            'amountPaid' => 'amount',
            'datePaid' => 'payment_date',
            'valueDate' => 'value_date',
            'payment_method' => 'payment_channel',
            'payerEmail' => 'email',
            'payerPhone' => 'phone',
            'createdDate' => 'created_at',
            'changedDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'bank_statement_id' => 'bankStatementIdentifier',
            'transaction_id' => 'transactionIdentifier',
            'currency_id' => 'currencyIdentifier',
            'partner_id' => 'partnerIdentifier',
            'depositor' => 'depositorName',
            'description' => 'paymentDescription',
            'amount' => 'amountPaid',
            'payment_date' => 'datePaid',
            'value_date' => 'valueDate',
            'payment_channel' => 'payment_method',
            'email' => 'payerEmail',
            'phone' => 'payerPhone',
            'created_at' => 'createdDate',
            'updated_at' => 'changedDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

}
