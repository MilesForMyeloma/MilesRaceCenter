<?php

class Race extends Eloquent {

    public $validator = array();

    public static $rules = array(
        'slug' => 'required|alpha_dash|unique:races',
        'timezone' => 'required|timezone',
        'startLocal' => 'date',
        'endLocal' => 'date'
    );

    protected $appends = array('startLocal','endLocal');
    protected $guarded = array();

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
            if(strtotime($startLocal)!==false) {
                $this->attributes['start'] = localToUtc($startLocal, $this->timezone);
            }
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
            if(isset($zones_by_string[$this->timezone])) 
            {
                $this->attributes['end'] = localToUtc($endLocal, $this->timezone);
            }
        }
    }

    /**
     * Get validation rules and take care of own id on update
     * @param null $id
     * @return array
     */
    public static function getValidationRules($id = null)
    {
        $rules = self::$rules;
 
        if($id === null)
        {
            return $rules;
        }
 
        array_walk($rules, function(&$rules, $field) use ($id)
        {
            if(!is_array($rules))
            {
                $rules = explode("|", $rules);
            }
 
            foreach($rules as $ruleIdx => $rule)
            {
                // get name and parameters
                @list($name, $params) = explode(":", $rule);
 
                // only do someting for the unique rule
                if(strtolower($name) != "unique") {
                    continue; // continue in foreach loop, nothing left to do here
                }
 
                $p = array_map("trim", explode(",", $params));
 
                // set field name to rules key ($field) (laravel convention)
                if(!isset($p[1])) {
                    $p[1] = $field;
                }
 
                // set 3rd parameter to id given to getValidationRules()
                $p[2] = $id;
 
                $params = implode(",", $p);
                $rules[$ruleIdx] = $name.":".$params;
            }
        });
 
        return $rules;
    }

}
