<?php

namespace App;

use App\Partner;
use App\Transformers\EmailTransformer;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{
    use SoftDeletes;

    use Traits\UsesUuid;

	const MESSAGE_SENT = 'sent';
	const MESSAGE_RESENT = 'resent';

    protected $primaryKey = 'email_id';
    public $transformer = EmailTransformer::class;
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

    protected $hidden = [
        'deleted_at',
    ];
}
