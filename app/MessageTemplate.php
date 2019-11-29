<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'message_template_id';
	protected $fillable = [
		'title',
    	'message',
	];
    
}
