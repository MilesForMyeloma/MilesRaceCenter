<?php

class Race extends Illuminate\Database\Eloquent\Model {

	protected $appends = array('startLocal','endLocal');

	/**
	 * Get an array for the race start in local time.
	 *
	 * @return array
	 */
	public function getStartLocalAttribute()
	{
		return utcToLocal($this->start, $this->timezone);
	}

	/**
	 * Set the event start time in UTC based on a local date time string and timezone
	 * @param  string  $startLocal
	 */
	public function setStartLocalAttribute($startLocal)
	{
		// If the timezone is valid
		if(isset(array_flip(DateTimeZone::listIdentifiers())[$this->timezone])) {

			$this->attributes['start'] = localToUtc($startLocal, $this->timezone);
		} else {
			dd("Invalid timezone;");
		}
	}

	/**
	 * Get an array for the race end in local time.
	 *
	 * @return array
	 */
	public function getEndLocalAttribute()
	{
		return utcToLocal($this->end, $this->timezone);
	}

	/**
	 * Set the event end time in UTC based on a local date time string and timezone
	 * @param  string  $endLocal
	 */
	public function setEndLocalAttribute($endLocal)
	{
		// If the timezone is valid
		if(isset(array_flip(DateTimeZone::listIdentifiers())[$this->timezone])) {

			$this->attributes['end'] = localToUtc($endLocal, $this->timezone);
		} else {
			dd("Invalid timezone;");
		}
	}

	protected $guarded = array();

	public static $rules = array();
}
