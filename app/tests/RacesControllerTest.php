<?php

class RacesControllerTest extends TestCase {

    public function setUp() {
        parent::setUp();
        $this->mock = Mockery::mock('Race');

    }

    public function tearDown()
    {
        Sentry::logout();
        Mockery::close();
    }

    public function beAdmin() {
        $admin = Sentry::findUserByLogin('admin@admin.com');
        Sentry::setUser($admin);
    }

    public function beUser() {
        $user = Sentry::findUserByLogin('user@user.com');
        Sentry::setUser($user);
    }

    public function testUserLogin() {
        $this->assertTrue(Sentry::getUser() == NULL, 'User should not by logged initially.');
        
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
                            'slug'=>'miles-for-mm',
                            'name'=>'Miles for Myeloma',
                            'start'=>'2014-10-29 14:00',
                            'end'=>'2014-10-29 18:00',
                            'description'=>'A race to run funds for Multiple Myeloma research',
                            'website'=>'http://www.milesformm.com',
                            'created_at'=>$now,
                            'updated_at'=>$now,
                            'timezone'=>'America/Chicago'
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

    public function testRacesDelete()
    {

        // Be an admin
        $this->beAdmin();

        // Delete the race
        $response = $this->delete(URL::action('RacesController@destroy', 'miles-for-mm'));
        $this->assertTrue(strcmp(Session::get('info'),'Race deleted.')===0,'Incorrect redirection message returned.');

        // Redirect back to the index
        $this->assertRedirectedToAction('RacesController@index');

        // Be a user
        $this->beUser();

        // Delete the race
        $response = $this->delete(URL::action('RacesController@destroy', 'miles-for-mm'));
        $this->assertTrue(strcmp(Session::get('error'),'Access denied.')===0,'User did not get access denied when deleting race.');

        // Redirect back to the index
        $this->assertRedirectedToAction('RacesController@index');
    }

}