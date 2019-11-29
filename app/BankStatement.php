<?php

namespace App;

use App\Bank;
use App\Currency;
use App\Payment;
use App\Transformers\BankStatementTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankStatement extends Model
{
    use SoftDeletes;

    public $transformer = BankStatementTransformer::class;
    protected $dates = ['deleted_at'];
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

     protected $hidden = [ 
        'deleted_at',
    ];

}
