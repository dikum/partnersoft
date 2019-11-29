<?php

namespace App;

use App\Country;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
	use Traits\UsesUuid;

	protected $primaryKey = 'continent_id';
    protected $fillable = [
    	'continent',
    	'continent_code',
    ];

    public function countries()
    {
    	return $this->hasMany(Country::class);
    }
}
