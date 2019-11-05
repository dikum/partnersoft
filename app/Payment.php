<?php

namespace App;

use App\BankStatement;
use App\Partner;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const PAYMENT_ENTERED_BY_SYSTEM = 'system';

    protected $fillable = [
    	'partner_id',
    	'bankstatement_id',
    	'entered_by',
    ];


    public function partner()
    {
    	return $this->belongsTo(Partner::class);
    }

    public function bank_statement()
    {
    	return $this->belongsTo(BankStatement::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
