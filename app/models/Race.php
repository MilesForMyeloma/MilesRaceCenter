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
	 * Get an array for the race end in local time.
	 *
	 * @return array
	 */
	public function getEndLocalAttribute()
	{
		return utcToLocal($this->end, $this->timezone);
	}

	protected $guarded = array();

	public static $rules = array();
}
