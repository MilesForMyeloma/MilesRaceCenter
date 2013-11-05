@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Race
@stop

{{-- Content --}}
@section('content')

<h1>View Race: {{{ $race->name }}}</h1>

	<div class="well clearfix">
    <div class="span7">
	    @if ($race->slug)
	    <p><strong>Slug:</strong> {{{ $race->slug }}} </p>
		@endif

		@if ($race->description)
	    <p><strong>Description:</strong> {{{ $race->description }}} </p>
		@endif

		@if ($race->start && $race->timezone)
		<p><strong>Start:</strong> {{{ $race->startLocal['fullstring'] }}}</p>
		@endif

		@if ($race->end && $race->timezone)
		<p><strong>End:</strong> {{{ $race->endLocal['fullstring'] }}}</p>
		@endif	

		@if ($race->timezone)
		<p><strong>Timezone:</strong> {{{ $race->timezone }}}</p>
		@endif		

	    @if ($race->website)
	    <p><strong>Website:</strong> {{{ $race->website }}}</p>
	    @endif

	    @if(Sentry::getUser() && Sentry::getUser()->hasAccess('admin'))
	    <button class="btn btn-info" onClick="location.href='{{ URL::to('races/'.$race->slug.'/edit') }}'">Edit Race</button>
	    @endif

	    @if(Sentry::getUser() && Sentry::getUser()->hasAccess('admin'))
		<button class="btn btn btn-success pull-right" onclick="location.href='{{ URL::to('races/create') }}'">New Race</button>
		@endif
	</div>
	<div class="span4">
		<p><em>Race created: {{ $race->created_at }}</em></p>
		<p><em>Last Updated: {{ $race->updated_at }}</em></p>
	</div>
</div>


@stop
