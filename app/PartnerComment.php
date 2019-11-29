<?php

namespace App;

use App\Partner;
use App\Transformers\PartnerCommentTransformer;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerComment extends Model
{
	use SoftDeletes;

	use Traits\UsesUuid;

	protected $primaryKey = 'comment_id';
	public $transformer = PartnerCommentTransformer::class;
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'partner_id',
		'user_id',
    	'comment',
	];

	public function partner()
	{
		return $this->belongsTo(Partner::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
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
