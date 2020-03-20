<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

	
class CurrencyHelper
{
	public static function get_currency_name($currency_id)
	{
		$currency_name = DB::table('currencies')
			->select('currency')
			->where('currency_id', '=', $currency_id)
			->value('currency_id');

		return $currency_name;
	}
}

?>