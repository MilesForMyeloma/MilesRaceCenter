<?php

use MilesForMyeloma\MilesRaceCenter\Race\RaceInterface as Race;
use MilesForMyeloma\MilesRaceCenter\Registration\RegistrationInterface as Registration;
use MilesForMyeloma\MilesRaceCenter\Donation\DonationInterface as Donation;

class RacesRegistrationsController extends BaseController {

    protected $race;
    protected $donation;
    protected $registration;

    /**
    *	Constructor
    */
    public function __construct(Race $race, Registration $registration, Donation $donation)
    {
        $this->race = $race;
        $this->donation = $donation;
        $this->registration = $registration;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($slug)
	{
		// Eager load the race and registrations
		// Todo: move to repository
		// RaceRepository::getRaceWithRegistrations()
		$race = $this->race->getRace($slug, array(
			'registrations.creator',
			'registrations.donations'
		));

		$registrations = $race[0]['registrations'];

		// Pass the race with registrations to the view
        return View::make('registrations.index', array(
        	'race' => $race,
        	'registrations' => $registrations
        ));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		// Show the form
        return View::make('registrations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// New registration object
		$this->donation = new Donation($input);
		$this->race = new Race($input);
		$this->registration = new Registration($this->race, $this->registration);

		//  Add race id to registration object
		// 	Add Donateable, type to Registration, set id to donateable id
		// 	  Add a new donation entry to donateable
		// 	Add a new user to the registration
		// 	Add new registrants
		// 	Add new purchaseable
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($race, $registration)
	{
		dd($this->registration);

        return View::make('registrations.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('registrations.edit');
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
		//
	}

}
