<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class UserController extends Controller
{
	/**
	 * Get all users
	 * 
	 * @return JSON
	 */
	public function index() 
	{
		$users  = User::all();

		return response()->json($users);
	}
	
	/**
	 * Get a single user
	 * 
	 * @param  integer $id
	 * 
	 * @return JSON
	 */
	public function getUser($id)
	{
		$user = User::findOrFail($id);

		return response()->json($user);
	}

	/**
	 * Create new user
	 * 
	 * @param  Request $request
	 * 
	 * @return JSON New User object
	 */
	public function createUser(Request $request)
	{
		$user = User::create($request->all());

		return response()->json($user);
	}

	/**
	 * Delete a user
	 * 
	 * @param  integer $id
	 * 
	 * @return JSON 'success' if deleted
	 */
	public function deleteUser($id)
	{
		$user = User::find($id);
		$user->delete();

		return response()->json('success');
	}

	/**
	 * Update the title or user of a User object
	 * 
	 * @param  Request $request
	 * @param  integer $id
	 * 
	 * @return JSON Updated User object
	 */
	public function updateUser(Request $request, $id)
	{
		$user           = User::find($id);
		$user->username = $request->input('username');
		$user->password = Hash::make($request->input('password'));
		$user->save();

		return response()->json($user);
	}
}