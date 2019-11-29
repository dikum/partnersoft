<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastPartnerNumber extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'last_partner_number_id';
	protected $fillable = [
    	'last_number',
	];
}
