<?php

# app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class User extends Model  
{
	public function queries()
	{
		return $this->hasMany('App\Models\Query');
	}
}