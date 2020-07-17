<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

	
class CurrencyHelper
{
	public static function get_currency_code($currency_id)
	{
		$currency_code = DB::table('currencies')
			->select('currency_code')
			->where('currency_id', '=', $currency_id)
			->value('currency_code');

		return $currency_code;
	}


	public static function get_currency_id_with_code($currency_code)
	{
		$currency_id = DB::table('currencies')
			->select('currency_id')
			->where('currency_code', '=', $currency_code)
			->value('currency_id');

		return $currency_id;
	}

	public static function getMinimumAmount($currency_id){
		$minimum_amount = DB::table('currencies')
			->select('minimum_amount')
			->where('currency_id', '=', $currency_id)
			->value('minimum_amount');

		return $minimum_amount;
	}
}
