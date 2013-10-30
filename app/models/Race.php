<?php

class Race extends Illuminate\Database\Eloquent\Model {

	protected $appends = array('startLocal','endLocal');

	protected $guarded = array();

	public $rules = array(
		'timezone' => 'required|timezone'
	);

	/**
	 * Accessor that gets an array for the race start in local time.
	 *
	 * @return array
	 */
	public function getStartLocalAttribute()
	{
		return utcToLocal($this->start, $this->timezone);
	}

	/**
	 * Mutator that sets event start time in UTC based on a local date time string and timezone
	 *
	 * @param  string  $startLocal
	 */
	public function setStartLocalAttribute($startLocal)
	{
		// Get timezones
		$zones_by_string = array_flip(DateTimeZone::listIdentifiers());

		// If the timezone is valid, use it to convert local time to UTC
		if(isset($zones_by_string[$this->timezone])) 
		{
			$this->attributes['start'] = localToUtc($startLocal, $this->timezone);
		}
	}

	/**
	 * Accessor that gets an array for the race end in local time.
	 *
	 * @return array
	 */
	public function getEndLocalAttribute()
	{
		return utcToLocal($this->end, $this->timezone);
	}

	/**
	 * Mutator that sets the event end time in UTC based on a local date time string and timezone
	 *
	 * @param  string  $endLocal
	 */
	public function setEndLocalAttribute($endLocal)
	{
		// Get timezones
		$zones_by_string = array_flip(DateTimeZone::listIdentifiers());

		// If the timezone is valid, use it to convert local time to UTC
		if(isset($zones_by_string[$this->timezone]))
		{
			$this->attributes['end'] = localToUtc($endLocal, $this->timezone);
		}
	}

	/**
	* Validates input data against this model's rules
	* 
	* @param array $data
	* @return bool
	*/
	public function validate($data)
    {

        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // return the result
        return $v->passes();
    }
}
