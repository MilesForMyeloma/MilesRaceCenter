@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Races
@stop

{{-- Content --}}
@section('content')

  @if (Sentry::check())
  	
    @if(Sentry::getUser()->hasAccess('admin'))
		<h4>Races</h4>
		<div class="well">
			<table class="table">
				<thead>
					<th>Name</th>
					<th>Options</th>
				</thead>
				<tbody>
					@foreach ($allRaces as $race)
						<tr>
							<td><a href="{{ URL::to('races/show') }}/{{ $race->slug }}">{{ $race->name }}</a></td>
							<td><button class="btn" onClick="location.href='{{ URL::to('races/edit') }}/{{ $race->slug}}'">Edit</button> <button class="btn action_confirm" href="{{ URL::to('races/delete') }}/{{ $race->id}}" data-token="{{ Session::getToken() }}" data-method="delete">Delete</button></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
    @else 
		<h4>You are not an Administrator</h4>
    @endif
  @else
    <h4>You are not logged in</h4>
  @endif


@stop
