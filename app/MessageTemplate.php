<?php

namespace App;

use App\Transformers\MessageTemplateTransformer;
use Illuminate\Database\Eloquent\Model;

class MessageTemplate extends Model
{
	public $transformer = MessageTemplateTransformer::class;
	protected $fillable = [
		'title',
    	'message',
	];
    
}
