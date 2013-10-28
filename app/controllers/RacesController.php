<?php

class RacesController extends BaseController {

	protected $race;
	/**
	*
	*/
	public function __construct(Race $race)
	{
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

		// localToUtc('2014-10-29 09:00am','America/Chicago')

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
	 * @param  string  $slug
	 * @return Response
	 */
	public function destroy($slug)
	{
		if(Sentry::check() && Sentry::getUser()->hasAccess('admin'))
		{
			$race = $this->race->where('slug',$slug)->first();
			$race->delete();
			Session::flash('info', 'Race deleted.');
			return Redirect::to(URL::action(get_class($this).'@index'));
		} else {
			Session::flash('error', 'Access denied.');
			return Redirect::to(URL::action(get_class($this).'@index'));
		}
	}

}
