<?php

namespace App;

use App\Bank;
use App\Currency;
use App\Payment;
use Illuminate\Database\Eloquent\Model;

class BankStatement extends Model
{
    protected $fillable = [
        'transaction_id',
    	'bank_id',
    	'currency_id',
        'partner_id',
        'depositor',
    	'description',
    	'amount',
        'payment_date',
        'value_date',
        'payment_channel',
        'email',
        'phone',	
    ];

    public function bank()
    {
    	return $this->belongsTo(Bank::class);
    }

    public function currency()
    {
    	return $this->belongsTo(Currency::class);
    }

    public function payment()
    {
    	return $this->hasOne(Payment::class);
    }
}
