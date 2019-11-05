<?php

namespace App;

use App\Partner;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $fillabel = [
    	'title',
    ];

    public function partners()
    {
    	return $this->hasMany(Partner::class);
    }
}
