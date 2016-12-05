<?php

use App\Models\User;  
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder  
{
	public function run()
	{
		DB::table('users')->delete();
		
		User::create([
			'username' => 'rossobrien',
			'password' => Hash::make('password')
		]);

		User::create([
			'username' => 'winston_churchill',
			'password' => Hash::make('password')
		]);

		User::create([
			'username' => 'confucius',
			'password' => Hash::make('password')
		]);
	}
}