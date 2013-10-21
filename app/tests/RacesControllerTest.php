<?php

class RacesControllerTest extends TestCase {

	public function __construct()
  	{
    	// We have no interest in testing Eloquent
    	$this->mock = Mockery::mock('Eloquent', 'Race');
  	}

  	public function setUp() {
  		parent::setUp();
    	/* 
    	 */
  	}

	public function tearDown()
	{
		Sentry::logout();
    	Mockery::close();
	}

	public function testUserLogin() {
		$this->assertTrue(Sentry::getUser() == NULL, 'User should not logged initially.');
		
		$admin = Sentry::findUserByLogin('admin@admin.com');
		$this->assertTrue($admin != NULL, 'Admin account not found.');

		$user = Sentry::findUserByLogin('user@user.com');
		$this->assertTrue($user != NULL, 'User account not found.');

		Sentry::setUser($user);
		$this->assertTrue(Sentry::check(),'User not logged in.');

		Sentry::setUser($admin);
		$this->assertTrue(Sentry::check(),'Admin not logged in.');

	}

	public function testRacesIndex()
	{

		$now = date('Y-m-d H:i:s');

		/* Check to make sure the all method is called on the model */
		$this->mock
           ->shouldReceive('all')
           ->once()->andReturn(
           		Mockery::mock(
           			array(
           				array(
							"slug"=>"miles-for-mm",
							"name"=>"Miles for Myeloma",
							"start"=>"2014-10-29 14:00",
							"end"=>"2014-10-29 18:00",
							"description"=>"A race to run funds for Multiple Myeloma research",
							"website"=>"http://www.milesformm.com",
							"created_at"=>$now,
							"updated_at"=>$now,
						)
					)
           		)
           	);

        // Tell Laravel to use our mocked instance of race, not the actual instance
        $this->app->instance('Race', $this->mock);

        	// Get the response of the races route via method: GET
			$response = $this->get('races');
			$this->assertResponseOk();	

		

		// Make sure we're passing the races param to the view
		$this->assertViewHas('races');


	}

}