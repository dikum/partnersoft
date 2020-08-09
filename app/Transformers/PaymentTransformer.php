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
            //'bank_statement' => $paymentBankStatement->index($payment),
            //'bank_statement' => $payment->bank_statement,
            'transactionIdenitifier' => $payment->bank_statement->transaction_id,
            'bankIdentifier' => $payment->bank_statement->bank_id,
            'currencyIdentifier' => $payment->bank_statement->currency_id,
            'friendlyPartnerIdentifier' => $payment->bank_statement->partner_id,
            'depositor' => $payment->bank_statement->depositor,
            'paymentDescription' => $payment->bank_statement->description,
            'amountPaid' => $payment->bank_statement->amount,
            'datePaid' => $payment->bank_statement->payment_date,
            'valueDate' => $payment->bank_statement->value_date,
            'paymentChannel' => $payment->bank_statement->payment_channel,
            'emailAddress' => $payment->bank_statement->email,
            'phoneNumber' => $payment->bank_statement->phone,
            'bankStatementCreatedDate' => $payment->bank_statement->created_at,
            'bankStatementUpdatedDate' => $payment->bank_statement->updated_at,



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
            'transactionIdenitifier' => 'transaction_id',
            'bankIdentifier' => 'bank_id',
            'currencyIdentifier' => 'currency_id',
            'friendlyPartnerIdentifier' => 'partner_id',
            'depositor' => 'depositor',
            'paymentDescription' => 'description',
            'amountPaid' => 'amount',
            'datePaid' => 'payment_date',
            'valueDate' => 'value_date',
            'paymentChannel' => 'payment_channel',
            'emailAddress' => 'email',
            'phoneNumber' => 'phone',
            'bankStatementCreatedDate' => 'created_at',
            'bankStatementUpdatedDate' => 'updated_at'

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
            'transaction_id' => 'transactionIdenitifier',
            'bank_id' => 'bankIdentifier',
            'currency_id' => 'currencyIdentifier',
            'partner_id' => 'friendlyPartnerIdentifier',
            'depositor' => 'depositor',
            'description' => 'paymentDescription',
            'amount' => 'amountPaid',
            'payment_date' => 'datePaid',
            'value_date' => 'valueDate',
            'payment_channel' => 'paymentChannel',
            'email' => 'emailAddress',
            'phone' => 'phoneNumber',
            'created_at' => 'bankStatementCreatedDate',
            'updated_at' => 'bankStatementUpdatedDate'
            
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
