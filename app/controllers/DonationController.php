<?php

use Omnipay\Common\GatewayFactory;
use Omnipay\Common\CreditCard;

class DonationController extends BaseController {

    protected $donation;
    /**
    *
    */
    /* public function __construct(Donation $donation)
    {
        $this->donation = $donation;
    } */

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    
         

        /*    OMNIPAY -- WORKING
        $factory = new GatewayFactory();
        $gateway = $factory->create('Stripe');
        $gateway->setApiKey(Config::get('app.payment.stripe.apikey',''));

        $formData = array('number' => '4242424242424242', 'expiryMonth' => '6', 'expiryYear' => '2016', 'cvv' => '123');
        $card = new CreditCard($formData);
        $response = $gateway->purchase(array('amount' => '10.00', 'currency' => 'USD', 'card' => $card))->send();

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
        //return View::make('donations.index');
        

        */

        //   PAYPAL -- WORKING

        
        $factory = new GatewayFactory();
        $gateway = $factory->create('PayPal_Express');
        $gateway->setUsername(Config::get('app.payment.paypalexpress.apiusername',''));
        $gateway->setPassword(Config::get('app.payment.paypalexpress.apipassword',''));
        $gateway->setSignature(Config::get('app.payment.paypalexpress.apisignature',''));
        $gateway->setTestMode(true);

        $response = $gateway->purchase(
            array(
                'amount' => '10.00', 
                'cancelUrl'=>Config::get('app.url'),
                'returnUrl'=>Config::get('app.url').'/paypalexpress_confirm',
            )
        )->send();


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


    }

    /**
     * Show the form for creating a new donation.
     *
     * @return Response
     */
    public function create()
    {
        // return View::make('donations.create');
    }

    /**
     * Determine payment method, send params to model
     * select next step.
     * If they choose stripe, make api call, if they use 
     * paypal express, redirect them.
     *
     * @return Response
     */
    public function store()
    {
        // 
    }

    /**
     * If they used paypal express or got redirected
     * handle the redirect back to us. Store the 
     * donation.
     *
     * @return Response
     */
    public function confirm($processor)
    {
        // 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // return View::make('donations.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
       // return View::make('donations.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        
    }

}
