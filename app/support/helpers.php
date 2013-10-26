<?php
if ( ! function_exists('utcToLocal'))
{
	/**
	* Convert datetime and timezone from UTC to Local string, datetime, and offset
	*
	*	@param string $utcDateTimeString
	*	@param string $timezoneString
	*	@return Converted Localized Array
	*/
	function utcToLocal($utcDateTimeString, $timezoneString) {
		$dzt = new DateTimeZone($timezoneString);
		$utc = new DateTimeZone('UTC');
		$dt = new DateTime($utcDateTimeString,$utc);
		$dt->setTimezone($dzt);

		return array(
		'fullstring' => $dt->format('Y-m-d h:ia') .' GMT' . number_format($dzt->getOffset($dt)/3600,1),
		'offset' => $dzt->getOffset($dt),
		 'datetime' => $dt
		 );
	}
}

if ( ! function_exists('localToUtc'))
{
	/**
	* Convert local datetime and timezone strings to UTC datetime
	*
	*	@param string $localDateTimeString
	*	@param string $timezoneString
	*	@return Converted UTC Datetime
	*/
	function localToUtc($localDateTimeString, $timezoneString) {
		$dzt = new DateTimeZone($timezoneString);
		$utc = new DateTimeZone('UTC');
		$dt = new DateTime($localDateTimeString, $dzt);
		$dt->setTimezone($utc);
		return $dt;
	}
}