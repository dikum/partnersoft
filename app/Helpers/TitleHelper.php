<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

	
class TitleHelper
{
	public static function get_title_name($title_id)
	{
		$title = DB::table('titles')
			->select('title')
			->where('title_id', '=', $title_id)
			->value('title');

		return $title;
	}
}

?>