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
		$results = array();
		try
		{
			$connectionPDO = \DB::connection('data')->getPdo();
			$connectionPDO->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
			$statement = $connectionPDO->prepare($this->query);
			$statement->execute();
			$count = 0;
			while ($record = $statement->fetch(\PDO::FETCH_ASSOC)) {
				if ($count < 50000)
				{
					$count++;
					$results[] = $record;
				}
				else 
				{
					break;
				}
			}
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