<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	/**
	* Overload the call method to allow for post, get, put etc
	*
	*/
	public function __call($method, $args)
	{
		if (in_array($method, ['get', 'post', 'put', 'patch', 'delete']))
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

}
