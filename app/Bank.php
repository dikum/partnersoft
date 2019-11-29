<?php

namespace App;

use App\BankStatement;
use App\Transformers\BankTransformer;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{

	public $transformer = BankTransformer::class;
    protected $fillable = [
    	'bank',
    	'bank_code',
    ];

    public function bank_statements()
    {
    	return $this->hasMany(BankStatement::class);
    }

    protected $hidden = [ 
        'deleted_at',
    ];

}
