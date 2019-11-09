<?php

namespace App;

use App\Partner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    

     /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

}
