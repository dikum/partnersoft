<?php

namespace App;

use App\BankStatement;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
    	'currency',
    	'currency_code',
    ];

    public function bank_statements()
    {
    	return $this->hasMany(BankStatement::class);
    }
}
