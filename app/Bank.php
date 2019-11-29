<?php

namespace App;

use App\BankStatement;
use Illuminate\Database\Eloquent\Model;
use Ryancco\HasUuidRouteKey\HasUuidRouteKey;

class Bank extends Model
{
	use Traits\UsesUuid;

    protected $fillable = [
    	'bank',
    	'bank_code',
    ];

    public function bank_statements()
    {
    	return $this->hasMany(BankStatement::class);
    }

}
