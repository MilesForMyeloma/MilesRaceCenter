<?php namespace MilesForMyeloma\MilesRaceCenter\Registration\Eloquent;

use MilesForMyeloma\MilesRaceCenter\Registration\RegistrationInterface;
use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentry\Users\Eloquent\User;

class Registration extends Model implements RegistrationInterface {
    protected $guarded = array();

    public static $rules = array();

    public function donations() {
        return $this->morphToMany('MilesForMyeloma\MilesRaceCenter\Donation\Eloquent\Donation', 'donateable');
    }

    public function race() {
        return $this->belongsTo('MilesForMyeloma\MilesRaceCenter\Race\Eloquent\Race');
    }

    public function creator() {
        return $this->belongsTo('Cartalyst\Sentry\Users\Eloquent\User');
    }

}
