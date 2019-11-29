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
            'bankIdentifier' => (int)$bank->id,
            'bankName' => (string)$bank->bank,
            'bankShortName' => (string)$bank->bank_code,
            'createdDate' => $bank->created_at,
            'changeDate' => $bank->updated_at,
        ];
    }
}
