<?php

class RaceControllerTest extends TestCase {

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

        // Check to make sure the all method is called on the model
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

    public function testRacesCreateAsUser()
    {
        // Be a user
        $this->beUser();

        // Don't allow users to create races
        $this->get(URL::action('RaceController@create'));
        $this->assertRedirectedToAction('RaceController@index');
        $this->assertSessionHas('error','Access denied.');
    }

    public function testRacesCreateAsAdmin()
    {
        // Be an admin
        $this->beAdmin();

        // Allow admins to create races
        $this->get(URL::action('RaceController@create'));
        $this->assertResponseOk();
    }

    public function testRacesStoreAsUser()
    {
        // Be a user
        $this->beUser();

        // Don't allow users to store races
        $this->post(URL::action('RaceController@store'));
        $this->assertRedirectedToAction('RaceController@index');
        $this->assertSessionHas('error','Access denied.');

    }

    public function testRacesStoreAsAdmin()
    {
        // Be a user
        $this->beAdmin();

        // No input provided
        $this->post(URL::action('RaceController@store'));
        $this->assertRedirectedToAction('RaceController@create');
        $this->assertSessionHasErrors();

        $now = date('Y-m-d H:i:s');

        // Store a race
        $this->app->instance('Race', $this->mock);
        $this->call('post',URL::action('RaceController@store'),array(
            'slug'=>'yard-for-mm',
            'name'=>'Yards for Myeloma',
            'timezone'=>'America/Chicago',
            'startLocal'=>'2014-10-29 14:00',
            'endLocal'=>'2014-10-29 18:00',
            'description'=>'A race to run funds for Multiple Myeloma research',
            'website'=>'http://www.yardsformm.com',
            'created_at'=>$now,
            'updated_at'=>$now,
        ));
        $this->assertRedirectedToAction('RaceController@index');
        $this->assertSessionHas('info','Race created.'); 
    }

    public function testRacesEditAsUser()
    {
        // Be a user
        $this->beUser();

        // Don't allow users to edit races
        $this->get(URL::action('RaceController@edit','miles-for-mm'));
        $this->assertRedirectedToAction('RaceController@index');
        $this->assertSessionHas('error','Access denied.');

    }

    public function testRacesUpdateAsUser()
    {
        // Be a user
        $this->beUser();

        // Don't allow users to edit races
        $this->put(URL::action('RaceController@update','miles-for-mm'));
        $this->assertRedirectedToAction('RaceController@index');
        $this->assertSessionHas('error','Access denied.');

    }

    public function testRacesDeleteAsUser()
    {

        // Be a user
        $this->beUser();

        // Delete the race
        $response = $this->delete(URL::action('RaceController@destroy', 'miles-for-mm'));
        $this->assertRedirectedToAction('RaceController@index');
        $this->assertSessionHas('error','Access denied.');

    }

    public function testRacesDeleteAsAdmin()
    {
        // Be an admin
        $this->beAdmin();

        // Delete the race
        $response = $this->delete(URL::action('RaceController@destroy', 'miles-for-mm'));
        $this->assertSessionHas('info','Race deleted.');
        $this->assertRedirectedToAction('RaceController@index');
    }

}