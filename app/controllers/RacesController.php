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
		$races = Race::all();
        return View::make('races.index')->with('races',$races);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Sentry::check() && Sentry::getUser()->hasAccess('admin'))
		{
	        return View::make('races.create');
	    } else {
			Session::flash('error', 'Access denied.');
			return Redirect::to(URL::action(get_class($this).'@index'));
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Sentry::check() && Sentry::getUser()->hasAccess('admin'))
		{
			$input = Input::only('slug', 'name', 'description', 'startLocal', 'endLocal', 'timezone', 'website');
			$race = new Race($input);
			$validator = Race::validateInstance($race,'create',$input);
			if($validator->passes()) {
				$race->save();
				Session::flash('info', 'Race created.');
				return Redirect::to(URL::action(get_class($this).'@index'));
			} else {
				return Redirect::to(URL::action(get_class($this).'@create'))->withInput()->withErrors($validator);
			}
		} else {
			Session::flash('error', 'Access denied.');
			return Redirect::to(URL::action(get_class($this).'@index'));
		}

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

        return View::make('races.show')->with('race',$race);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function edit($slug)
	{
		if(Sentry::check() && Sentry::getUser()->hasAccess('admin'))
		{
			$input = Input::only('slug', 'name', 'description', 'startLocal', 'endLocal', 'timezone', 'website');
			$race = $this->race->where('slug',$slug)->first();

        	return View::make('races.edit')->with('race',$race);
        } else {
        	Session::flash('error', 'Access denied.');
			return Redirect::to(URL::action(get_class($this).'@index'));
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  slug  $slug
	 * @return Response
	 */
	public function update($slug)
	{
		$race = $this->race->where('slug',$slug)->first();
		$input = Input::only('slug', 'name', 'description', 'startLocal', 'endLocal', 'timezone', 'website');

		$validator = Validator::make($input, Race::getValidationRules());
		// pass the race, what we want to do to it, and the input, expect a validator object
			if($validator->passes()) {
				$race->slug = $input['slug'];
				$race->name = $input['name'];
				$race->description = $input['description'];
				$race->startLocal = $input['startLocal'];
				$race->endLocal = $input['endLocal'];
				$race->timezone = $input['timezone'];
				$race->website = $input['website'];
				$race->save();
				Session::flash('info', 'Race updated.');
				return Redirect::to(URL::action(get_class($this).'@index'));
			} else {
				return Redirect::to(URL::action(get_class($this).'@edit',$race->slug))->withInput()->withErrors($validator);
			}
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
