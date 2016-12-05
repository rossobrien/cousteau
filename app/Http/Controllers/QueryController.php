<?php

namespace App\Http\Controllers;

use App\Models\Query;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class QueryController extends Controller
{
	/**
	 * Get all queries
	 * 
	 * @return JSON
	 */
	public function index() 
	{
		$queries  = Query::all()->load('user');

		return response()->json($queries);
	}
	
	/**
	 * Get a single query
	 * 
	 * @param  integer $id
	 * 
	 * @return JSON
	 */
	public function getQuery($id)
	{
		$query = Query::findOrFail($id)->load('user');

		return response()->json($query);
	}

	/**
	 * Create new query
	 * 
	 * @param  Request $request
	 * 
	 * @return JSON New Query object
	 */
	public function createQuery(Request $request)
	{
		$query = Query::create($request->all());

		return response()->json($query);
	}

	/**
	 * Delete a query
	 * 
	 * @param  integer $id
	 * 
	 * @return JSON 'success' if deleted
	 */
	public function deleteQuery($id)
	{
		$query = Query::find($id);
		$query->delete();

		return response()->json('success');
	}

	/**
	 * Update the title or query of a Query object
	 * 
	 * @param  Request $request
	 * @param  integer $id
	 * 
	 * @return JSON Updated Query object
	 */
	public function updateQuery(Request $request, $id)
	{
		$query        = Query::find($id);
		$query->title = $request->input('title');
		$query->query = $request->input('query');
		$query->save();

		return response()->json($query);
	}
}