<?php

namespace App;

use App\BankStatement;
use App\Transformers\BankTransformer;
use Illuminate\Database\Eloquent\Model;
use Ryancco\HasUuidRouteKey\HasUuidRouteKey;

class Bank extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'bank_id';

	public $transformer = BankTransformer::class;
    protected $fillable = [
    	'bank',
    	'bank_code',
    ];

    public function bank_statements()
    {
    	return $this->hasMany(BankStatement::class, 'bank_id');
    }

    protected $hidden = [ 
        'deleted_at',
    ];

}
