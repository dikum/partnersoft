<?php

namespace App;

use App\Partner;
use App\Transformers\TitleTransformer;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
	use Traits\UsesUuid;

	public $transformer = TitleTransformer::class;
	protected $primaryKey = 'title_id';
    protected $fillable = [
    	'title',
    ];

    public function partners()
    {
    	return $this->hasMany(Partner::class, 'title_id');
    }
}
