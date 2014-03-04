@extends('layouts.default')

{{-- Web site Title --}}
@section('title')
@parent
Register
@stop

{{-- Content --}}
@section('content')

<h4>{{ $race[0]['name'] }} Registrations</h4>
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <th>Registrant</th><th>Time Submitted</th>
            </thead>
            <tbody>
            @foreach ($registrations as $registration)
                <tr>
                    <td><a href="{{ URL::action('Sentinel\UserController@show',$registration['creator']['id']) }}">{{$registration['creator']['email']}}</a></td><td>{{ $registration['created_at'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
   </div>
</div>

@stop