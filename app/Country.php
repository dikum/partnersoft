<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
      'continent_id',
      'country',
      'dial_code',
      'country_code',
    ];

    public function continent()
    {
      return $this->belongsTo(Continent::class);
    }
}
