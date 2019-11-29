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
            'paymentIdentifier' => (int)$payment->id,
            'partnerIdentifier' => (int)$payment->partner_id,
            'bankStatementIdentifier' => (int)$payment->bank_statment_id,
            'userIdentifier' => (int)$payment->user_id,
            'createdDate' => $payment->created_at,
            'changeDate' => $payment->updated_at,
        ];
    }
}
