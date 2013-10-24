<?php

class RacesController extends BaseController {

	protected $race;
	/**
	*
	*/
	public function __construct(Race $race) {
		$this->race = $race;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$races = $this->race->all();
        return View::make('races.index')->with('races',$races);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('races.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//

		$race = new Race();

		dd(Input::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		$race = $this->race->where('slug',$slug)->first();


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

		function localToUtc($localDateTimeString, $timezoneString) {
			$dzt = new DateTimeZone($timezoneString);
			$utc = new DateTimeZone('UTC');
			$dt = new DateTime($localDateTimeString, $dzt);
			$dt->setTimezone($utc);
			return $dt;
		}

		dd(
			array(
				utcToLocal($race->start, $race->timezone),
				utcToLocal($race->end, $race->timezone),
				localToUtc('2014-10-29 09:00am','America/Chicago')
			)
		);
        return View::make('races.show')->with('race',$race);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('races.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
