<?php namespace MilesForMyeloma\MilesRaceCenter\Donation;

interface DonationInterface {

    public function donateable();
    public function registrations();
    public function donationEntries();

}