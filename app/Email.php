<?php

namespace App;

use App\Partner;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;

    use Traits\UsesUuid;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
