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


Route::get('/', function()
{
	return View::make('hello');
});

Route::controller('users', 'UserController');

Route::resource('groups', 'GroupController');

Route::resource('races', 'RacesController');

use Omnipay\Common\GatewayFactory;

Route::get('donate', function(){

	$gateway = GatewayFactory::create('Stripe');
	$gateway->setApiKey(Config::get('app.stripe.apikey',''));

	$formData = ['number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123'];
	$response = $gateway->purchase(['amount' => '10.00', 'currency' => 'USD', 'card' => $formData])->send();

	if ($response->isSuccessful()) {
	    // payment was successful: update database
	    dd($response);
	} elseif ($response->isRedirect()) {
	    // redirect to offsite payment gateway
	    $response->redirect();
	} else {
	    // payment failed: display message to customer
	    dd($response->getMessage());
	}

});