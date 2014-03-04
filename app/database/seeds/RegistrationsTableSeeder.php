<?php

class RegistrationsTableSeeder extends Seeder {

	public function run()
	{
        // Uncomment the below to wipe the table clean before populating
        DB::table('registrations')->truncate();

        $now = date('Y-m-d H:i:s');

        $registrations = array(
            "donation_id"=>1,
            "race_id"=>1,
            "creator_id"=>2,
            "created_at"=>$now,
            "updated_at"=>$now
        );

        // Uncomment the below to run the seeder
        DB::table('registrations')->insert($registrations);
	}

}
