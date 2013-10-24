<?php

class RacesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('races')->truncate();

		$now = date('Y-m-d H:i:s');

		$races = array(
			"slug"=>"miles-for-mm",
			"name"=>"Miles for Myeloma",
			"start"=>"2014-10-29 14:00",
			"end"=>"2014-10-29 18:00",
			"description"=>"A race to run funds for Multiple Myeloma research",
			"website"=>"http://www.milesformm.com",
			"created_at"=>$now,
			"updated_at"=>$now,
			"timezone"=>"America/Chicago",
		);

		// Uncomment the below to run the seeder
		DB::table('races')->insert($races);
	}

}
