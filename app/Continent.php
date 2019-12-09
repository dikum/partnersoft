<?php

namespace App;

use App\Country;
use App\Transformers\ContinentTransformer;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'continent_id';
	public $transformer = ContinentTransformer::class;
    protected $fillable = [
    	'continent',
    	'continent_code',
    ];

    public function countries()
    {
    	return $this->hasMany(Country::class);
    }
}
