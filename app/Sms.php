<?php

namespace App;

use App\Partner;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sms extends Model
{
    use SoftDeletes;

	const MESSAGE_SENT = 'sent';
	const MESSAGE_RESENT = 'resent';

    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'partner_id',
        'user_id',
    	'sender',
    	'recipient',
    	'message',
    	'status',
    ];

    public function partner()
    {
    	return $this->belongsTo(Partner::class);
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
