<?php

namespace App;

use App\Partner;
use Illuminate\Database\Eloquent\Model;

class PartnerComment extends Model
{
	protected $fillable = [
		'partner_id',
    	'comment',
	];

	public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
    
}
