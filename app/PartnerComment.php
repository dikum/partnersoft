<?php

namespace App;

use App\Partner;
use Illuminate\Database\Eloquent\Model;

class PartnerComment extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = [
		'partner_id',
    	'comment',
	];

	public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
    
}
