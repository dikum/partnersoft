<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

	
class CountryHelper
{
	public static function get_country_name($country_id)
	{
		$country_name = DB::table('countries')
			->select('country')
			->where('country_id', '=', $country_id)
			->value('user_id');

		return $country_name;
	}
}

?>