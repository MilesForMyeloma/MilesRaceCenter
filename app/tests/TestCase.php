<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {


	protected $useDatabase = true;

	/**
	* Overload the call method to allow for lazy post, get, put etc
	*
	*/
	public function __call($method, $args)
	{
		if (in_array($method, array('get', 'post', 'put', 'patch', 'delete')))
		{
   			return $this->call($method, $args[0]);
    	}
    	
    	throw new BadMethodCallException;
	}

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/**
	* Set up function for all tests
	*
	*/
	public function setUp()
    {
        parent::setUp();
        if($this->useDatabase)
        {
            $this->setUpDb();
        }
    }

	/**
	* Tear down function for all tests
	*
	*/
    public function teardown()
    {
        Mockery::close();
    }

    /**
	* Set up the database for tests
	*
	*/
    public function setUpDb()
    {
    	Artisan::call('migrate', array('--package'=>'cartalyst/sentry'));
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    /**
	* Tear down the database for tests
	*
	*/
    public function teardownDb()
    {
        Artisan::call('migrate:reset');
    }

}
