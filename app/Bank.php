<?php

namespace App;

use App\BankStatement;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
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
