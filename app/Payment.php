<?php

namespace App;

use App\BankStatement;
use App\Partner;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    const PAYMENT_ENTERED_BY_SYSTEM = 'system';

    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'partner_id',
    	'bank_statement_id',
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

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

}
