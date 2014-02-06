<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/* Route::get('/', function()
{
	
}); */

// Route::controller('users', 'UserController');

Route::resource('donations', 'DonationController');

// Route::resource('groups', 'GroupController');

Route::resource('races', 'RaceController');

// Set Home Route
 Route::get('/', array('as' => 'home', function()
{
    return View::make('hello');
}));