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
            'paymentIdentifier' => (string)$bank_statement->bank_statement_id,
            'transactionIdentifier' => (string)$bank_statement->transaction_id,
            'currency_id' => (string)$bank_statement->currency_id,
            'partnerIdentifier' => (string)$bank_statement->partner_id,
            'depositorName' => (string)$bank_statement->depositor,
            'description' => (string)$bank_statement->description,
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
}
