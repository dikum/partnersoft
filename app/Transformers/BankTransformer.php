<?php

namespace App\Transformers;

use App\Bank;
use League\Fractal\TransformerAbstract;

class BankTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Bank $bank)
    {
        return [
            'bankIdentifier' => (string)$bank->bank_id,
            'bankName' => (string)$bank->bank,
            'bankShortName' => (string)$bank->bank_code,
            'createdDate' => (string)$bank->created_at,
            'changeDate' => (string)$bank->updated_at,
        ];
    }
}
