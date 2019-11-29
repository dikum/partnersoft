<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastPartnerNumber extends Model
{
	use Traits\UsesUuid;

	protected $fillable = [
    	'last_number',
	];
}
