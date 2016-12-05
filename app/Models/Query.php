<?php

# app/Models/Query.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Query extends Model
{
	/**
	 * Users relation
	 */
	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	/**
	 * Run query
	 * 
	 * @return array Query data
	 */
	public function getDataAttribute()
	{
		try
		{
			$results = \DB::connection('data')->select($this->query);
		}
		catch (\Exception $ex)
		{
			return $ex->getMessage();
		}

		//Get rid of STDClass object
		return json_decode(json_encode($results),true);
	}

	/**
	 * Override parent toArray function to include data
	 * 
	 * @return array
	 */
	public function toArray()
	{
		$array = parent::toArray();
		$array['data'] = $this->data;
		return $array;
	}
}