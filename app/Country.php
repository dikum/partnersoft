<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    use Traits\UsesUuid;

    protected $primaryKey = 'country_id';
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
