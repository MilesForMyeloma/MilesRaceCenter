<?php

class RacesControllerTest extends TestCase {

	public function testIndex()
	{
		$this->client->request('GET','races');
	}

}