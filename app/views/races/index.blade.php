@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Races
@stop

{{-- Content --}}
@section('content')
<h4>Races</h4>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="table-responsive">
			<table class="table table-striped table-hover">
				<thead>
					<th>Name</th>
					@if(Sentry::getUser() && Sentry::getUser()->hasAccess('admin'))
					<th>Options</th>
					@endif
				</thead>
				<tbody>
					@foreach ($races as $race)
						<tr>
							<td><a href="{{ URL::to('races/'.$race->slug) }}">{{{ $race->name }}}</a></td>
							@if(Sentry::getUser() && Sentry::getUser()->hasAccess('admin'))
							<td><button class="btn btn-default" onClick="location.href='{{ URL::to('races/'.$race->slug.'/registrations') }}'">Registrations</button> <button class="btn btn-default" onClick="location.href='{{ URL::to('races/'.$race->slug.'/edit') }}'">Edit</button> <button class="btn btn-default action_confirm" href="{{ URL::to('races/'.$race->slug) }}" data-token="{{ Session::getToken() }}" data-method="delete">Delete</button></td>
							@endif
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@if(Sentry::getUser() && Sentry::getUser()->hasAccess('admin'))
		<button class="btn btn-primary" onclick="location.href='{{ URL::to('races/create') }}'">New Race</button>
		@endif
	</div>
</div>
@stop
