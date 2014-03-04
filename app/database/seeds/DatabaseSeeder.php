<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Illuminate\Database\Eloquent\Model::unguard();

		// $this->call('UserTableSeeder');
		// $this->call('SentryGroupSeeder');
		// $this->call('SentryUserSeeder');
		// $this->call('SentryUserGroupSeeder');
		$this->call('RacesTableSeeder');
		$this->call('DonationsTableSeeder');
		$this->call('RegistrationsTableSeeder');
		$this->call('DonationentriesTableSeeder');
	}

}