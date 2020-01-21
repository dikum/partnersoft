<?php

namespace App;

use App\Transformers\StateTransformer;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
	const NOT_AVAILABLE = 'not available';

	use Traits\UsesUuid;

	public $transformer = StateTransformer::class;
	protected $primaryKey = 'state_id';
    protected $fillable = [
    	'state',
    ];

}
