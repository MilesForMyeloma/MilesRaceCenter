@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Hello World
@stop

{{-- Content --}}
@section('content')

<h2>Miles for Myeloma</h2>
<div class="well">
	<p>
		Miles for Myeloma is an organization dedicated to raising funds for Myeloma research. To accomplish this goal, we organize an annual walk/run in Iowa City, Iowa.  All funds raised are donated to the Multiple Myeloma Research Foundation.
	</p>
	<p> To get started, sign up for the walk/run, volunteer to help out, or donate to Miles for Myeloma.</p>
</div>

@if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
	<h4>Admin Options</h4>
	<div class="well">
		 <button class="btn btn-info" onClick="location.href='{{ URL::to('users') }}'">View Users</button>
		 <button class="btn btn-info" onClick="location.href='{{ URL::to('groups') }}'">View Groups</button>
	</div>
@endif


@stop