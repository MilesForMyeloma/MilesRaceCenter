<?php
		use Omnipay\Common\GatewayFactory;
	use Omnipay\Common\CreditCard;

class DonationController extends BaseController {

	protected $donations;
	/**
	*
	*/
	public function __construct(Donation $race)
	{
		$this->donation = $donation;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	
		$gateway = GatewayFactory::create('Stripe');
		$gateway->setApiKey(Config::get('app.stripe.apikey',''));

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

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
       // return View::make('donations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
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
