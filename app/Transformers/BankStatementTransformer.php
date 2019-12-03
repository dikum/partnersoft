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
            'currency_id' => (string)$bank_statement->currency_id,
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
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'bankStatementIdentifier' => 'bank_statement_id',
            'transactionIdentifier' => 'transaction_id',
            'currency_id' => 'currency_id',
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
}
