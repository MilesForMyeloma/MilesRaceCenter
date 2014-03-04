<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonateablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('donateables', function(Blueprint $table) {
			$table->increments('id');
			$table->string('donateable_type')->index();
			$table->integer('donateable_id')->unsigned()->index();
			$table->integer('donation_id')->unsigned()->index ();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('donateables');
	}

}
