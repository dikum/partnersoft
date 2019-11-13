<?php

namespace App;

use App\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
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
    	'subject',
    	'message',
    	'status',

    ];

    public function partner()
    {
    	return $this->belongsTo(Partner::class);
    }
}
