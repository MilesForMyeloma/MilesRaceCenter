<?php

class MilesRaceCenterValidator extends Illuminate\Validation\Validator {

	/**
	* Timezone validation
	*
	* @param array $attribute
	* @param array $value
	* @param array $parameters
	* @return bool
	*/
    public function validateTimezone($attribute, $value, $parameters)
    {
		return in_array($value, DateTimeZone::listIdentifiers(), true);
    }

}