<?php

namespace App;

use App\Transformers\MessageTemplateTransformer;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'message_template_id';
	public $transformer = MessageTemplateTransformer::class;
	protected $fillable = [
		'title',
    	'message',
	];
    
}
