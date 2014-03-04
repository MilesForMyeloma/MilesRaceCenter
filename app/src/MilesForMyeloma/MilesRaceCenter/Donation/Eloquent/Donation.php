<?php namespace MilesForMyeloma\MilesRaceCenter\Donation\Eloquent;

use MilesForMyeloma\MilesRaceCenter\Donation\DonationInterface;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model implements DonationInterface {

    protected $guarded = array();

    public static $rules = array();

    // We need registrations to own donations but also
    // need users, groups and races to own donations.
    public function donateable() {
        return $this->morphToMany('MilesForMyeloma\MilesRaceCenter\Donation\Eloquent\Donation','donateable');
    }

    // A single donation might
    public function registrations() {
        return $this->morphedByMany('MilesForMyeloma\MilesRaceCenter\Registration\Eloquent\Donation','registrations');
    }

    // A single donation might consist of multiple donation entries
    public function donationEntries() {
        return $this->hasMany('DonationEntry');
    }
}