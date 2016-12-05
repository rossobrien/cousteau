<?php
/*
 * Application Routes
*/

use App\Models\User;
use App\Models\Query;

/**
 * Homepage
 */
$app->get('/', function() use ($app) {
	return "Welcome to the Cousteau Data Explorer API";
});


$app->group(['namespace' => 'App\Http\Controllers'], function($group){
	/**
	 * User API Routes
	 */
	$group->get('/users/', 'UserController@index');
	$group->get('/users/{id}', 'UserController@getUser');

	/**
	 * Query API Routes
	 */
	$group->get('/queries/', 'QueryController@index');
	$group->get('/queries/{id}', 'QueryController@getQuery');
});

