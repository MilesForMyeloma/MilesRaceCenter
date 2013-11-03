<?php

class Race extends Illuminate\Database\Eloquent\Model {

	public $validator = array();

	public static $createRules = array(
		'slug' => 'required|alpha_dash|unique:races',
		'timezone' => 'required|timezone'
	);
	public static $updateRules = array (
		'slug' => 'required|alpha_dash|unique:races,slug,{ID}',
		'timezone' => 'required|timezone'
	);

	protected $appends = array('startLocal','endLocal');
	protected $guarded = array();

 	public static function boot()
    {
    	parent::boot();

		static::creating(function($race)
        {

            return Race::validateInstance($race,'create')->passes();

        });

    	static::updating(function($race)
        {
            return Race::validateInstance($race,'update',$race->getOriginal())->passes();
        });

    }

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
	* Validates a race against instance
	*
	* Validates a race instance against a set of validation rules
	* that are defined for that action
	* 
	* @param array $data
	* @param string $validationMethod
	* @return Validator
	*/
    public static function validateInstance($race, $validationMethod, $input) {
    	$rules = '';

    	if( $validationMethod == 'create' )
    	{
    		// Transform validation rules to be permissive
    		$rules = self::$createRules;

    		return Validator::make($race->attributes, self::$createRules);

    	} elseif ( $validationMethod == 'update' ) {
    		
    		// we're updating but not changing the slug
    		if(strcmp($race->attributes['slug'], $input['slug'])==0) 
    		{

    			$rules = self::$updateRules;

    			$variables = array('id' => $race->attributes['id']);
    		
    			foreach($variables as $key => $value)
    			{
			    	$rules = str_replace('{'.strtoupper($key).'}', $value, $rules);
				}
				return Validator::make($race->attributes, $rules);
    		} else {
    			$rules = self::$createRules;
    			return Validator::make($race->attributes, $rules);
    		}

    	} else {
    		throw new Exception('Invalid validation method, please use either: create or update.');
    	}
    }
}
