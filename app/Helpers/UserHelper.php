<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

	
class UserHelper
{
	public static function get_users_name($user_id)
	{
		$name = DB::table('users')
			->select('name')
			->where('user_id', '=', $user_id)
			->value('name');

		return $name;
	}
}

?>