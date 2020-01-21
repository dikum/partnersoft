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

    public static function originalAttribute($index)
    {
        $attributes = [

            'bankIdentifier' => 'bank_id',
            'bankName' => 'bank',
            'bankShortName' => 'bank_code',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }


    public static function transformedAttribute($index)
    {
        $attributes = [

            'bank_id' => 'bankIdentifier',
            'bank' => 'bankName',
            'bank_code' => 'bankShortName',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }    
}
