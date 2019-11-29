<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
	use Traits\UsesUuid;
	
	protected $fillable = [
		'title',
    	'message',
	];
    
}
