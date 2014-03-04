<?php namespace MilesForMyeloma\MilesRaceCenter\DonationEntry\Eloquent;

use MilesForMyeloma\MilesRaceCenter\DonationEntry\DonationEntryInterface;
use Illuminate\Database\Eloquent\Model;

class DonationEntry extends Eloquent implements DonationEntryInterface {
    protected $guarded = array();

    public static $rules = array();

    public function donation() {
        return $this->belongsTo('Donation');
    }

}
