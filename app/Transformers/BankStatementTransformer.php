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
            'paymentIdentifier' => (int)$bank_statement->id,
            'transactionIdentifier' => (string)$bank_statement->transaction_id,
            'currency_id' => (int)$bank_statement->currency_id,
            'partnerIdentifier' => $bank_statement->partner_id,
            'depositorName' => $bank_statement->depositor,
            'description' => $bank_statement->description,
            'amountPaid' => $bank_statement->amount,
            'datePaid' => $bank_statement->payment_date,
            'valueDate' => $bank_statement->value_date,
            'payment_method' => $bank_statement->payment_channel,
            'payerEmail' => $bank_statement->email,
            'payerPhone' => $bank_statement->phone,
            'createdDate' => $bank_statement->created_at,
            'changedDate' => $bank_statement->updated_at,
        ];
    }
}
