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

// Set Home Route
 Route::get('/', array('as' => 'home', function()
{
    return View::make('hello');
}));

Route::resource('races', 'RaceController');
Route::resource('races.registrations', 'RacesRegistrationsController');

Route::resource('donations', 'DonationController');
Route::resource('donationentries', 'DonationentriesController');