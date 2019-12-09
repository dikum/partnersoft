<?php

namespace App;

use App\BankStatement;
use App\Transformers\CurrencyTransformer;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'currency_id';

	public $transformer = CurrencyTransformer::class;
    protected $fillable = [
    	'currency',
    	'currency_code',
    	'minimum_amount',
    ];

    public function bank_statements()
    {
    	return $this->hasMany(BankStatement::class, 'currency_id');
    }
}
