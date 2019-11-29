<?php

namespace App;

use App\BankStatement;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'currency_id';
    protected $fillable = [
    	'currency',
    	'currency_code',
    	'minimum_amount',
    ];

    public function bank_statements()
    {
    	return $this->hasMany(BankStatement::class);
    }
}
