<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	const NOT_AVAILABLE = 'not available';

	use Traits\UsesUuid;
	
    protected $fillable = [
    	'state',
    ];

}
