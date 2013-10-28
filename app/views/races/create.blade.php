@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Create Race
@stop

{{-- Content --}}
@section('content')

	<h1>Races</h1>
	{{ Form::open(array('url' => URL::to('races/'), 'method' => 'post')) }}

		<div class="control-group {{ ($errors->has('slug')) ? 'error' : '' }}" for="slug">
            <label class="control-label" for="slug">Slug</label>
            <div class="controls">
                <input name="slug" id="slug" value="{{ Request::old('slug') }}" type="text" class="input-xlarge" placeholder="Slug">
                {{ ($errors->has('slug') ? $errors->first('slug') : '') }}
            </div>
        </div>	

        <div class="control-group {{ ($errors->has('name')) ? 'error' : '' }}" for="name">
            <label class="control-label" for="name">Name</label>
            <div class="controls">
                <input name="name" id="name" value="{{ Request::old('name') }}" type="text" class="input-xlarge" placeholder="Name">
                {{ ($errors->has('name') ? $errors->first('name') : '') }}
            </div>
        </div>	

		<div class="control-group {{ ($errors->has('timezone')) ? 'error' : '' }}" for="imezone">
            <label class="control-label" for="timezone">Timezone</label>
            <div class="controls">
                <input name="timezone" id="timezone" value="{{ Request::old('timezone') }}" type="text" class="input-xlarge" placeholder="Timezone">
                {{ ($errors->has('timezone') ? $errors->first('timezone') : '') }}
            </div>
        </div>	

		<div class="control-group {{ ($errors->has('start')) ? 'error' : '' }}" for="start">
            <label class="control-label" for="start">Start</label>
            <div class="controls">
                <input name="start" id="start" value="{{ Request::old('start') }}" type="text" class="input-xlarge" placeholder="Start">
                {{ ($errors->has('start') ? $errors->first('start') : '') }}
            </div>
        </div>	

		<div class="control-group {{ ($errors->has('end')) ? 'error' : '' }}" for="end">
            <label class="control-label" for="end">End</label>
            <div class="controls">
                <input name="end" id="end" value="{{ Request::old('end') }}" type="text" class="input-xlarge" placeholder="End">
                {{ ($errors->has('end') ? $errors->first('end') : '') }}
            </div>
        </div>	

		<div class="control-group {{ ($errors->has('website')) ? 'error' : '' }}" for="website">
            <label class="control-label" for="website">Website</label>
            <div class="controls">
                <input name="website" id="website" value="{{ Request::old('website') }}" type="text" class="input-xlarge" placeholder="Website">
                {{ ($errors->has('website') ? $errors->first('website') : '') }}
            </div>
        </div>	

		<div class="form-actions">
	    	<input class="btn-primary btn" type="submit" value="Create"> 
	    	<input class="btn " type="reset" value="Reset">
	    </div>	

	{{ Form::close() }}
@stop