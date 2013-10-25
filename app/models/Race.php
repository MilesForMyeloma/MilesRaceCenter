<?php

class Race extends Eloquent {

	/**
	 * Get an array for the race start in local time.
	 *
	 * @return array
	 */
	public function getStartLocal()
	{
		return utcToLocal($this->start, $this->timezone);
	}

	/**
	 * Get an array for the race end in local time.
	 *
	 * @return array
	 */
	public function getEndLocal()
	{
		return utcToLocal($this->end, $this->timezone);
	}

	protected $guarded = array();

	public static $rules = array();
}
