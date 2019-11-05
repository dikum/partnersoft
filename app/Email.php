<?php

namespace App;

use App\Partner;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
	const MESSAGE_SENT = 'sent';
	const MESSAGE_RESENT = 'resent';

    protected $fillable = [
    	'partner_id',
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
