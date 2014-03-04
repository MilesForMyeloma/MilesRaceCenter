<?php namespace MilesForMyeloma\MilesRaceCenter;

use Illuminate\Support\ServiceProvider;

class MilesRaceCenterServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind(
      'MilesForMyeloma\MilesRaceCenter\Donation\DonationInterface',
      'MilesForMyeloma\MilesRaceCenter\Donation\Eloquent\Donation'
    );
    $this->app->bind(
      'MilesForMyeloma\MilesRaceCenter\Race\RaceInterface',
      'MilesForMyeloma\MilesRaceCenter\Race\Eloquent\Race'
    );
    $this->app->bind(
      'MilesForMyeloma\MilesRaceCenter\Registration\RegistrationInterface',
      'MilesForMyeloma\MilesRaceCenter\Registration\Eloquent\Registration'
    );
  }

}