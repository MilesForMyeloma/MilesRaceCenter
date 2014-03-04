<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>
			@section('title')
			@show - Miles for Myeloma
		</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Bootstrap 3.0: Latest compiled and minified CSS -->
		<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"> -->
		<link rel="stylesheet" href="{{ asset('packages/rydurham/sentinel/css/bootstrap.min.css') }}">

		<!-- Optional theme -->
		<!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css"> -->
		<link rel="stylesheet" href="{{ asset('packages/rydurham/sentinel/css/bootstrap-theme.min.css') }}">

		<style>
		@section('styles')
			body {
				padding-top: 60px;
			}

			.nav .caret, .nav a:active .caret {
				border-top-color: #999;
				border-bottom-color: #999;
			}

			.nav a:hover .caret {
				border-top-color: #fff;
				border-bottom-col: #fff;
			}

			/* Hack for iOS phone input focus glitch */
			input[type="text"], input[type="password"], input[type="phone"],  textarea {
        		font-size:16px;
			}
		@show
		</style>

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->


	</head>

	<body>


		<!-- Navbar -->
		<div class="navbar navbar-inverse navbar-fixed-top">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="{{ URL::route('home') }}">Miles for Myeloma</a>
	        </div>
	        <div class="collapse navbar-collapse">
	          <ul class="nav navbar-nav navbar-right">
	            @if (Sentry::check() && Sentry::getUser()->hasAccess('admin'))
	            <li>
	            	<a href="javascript:void(0);" class="dropdown-toggle hidden-xs" data-toggle="dropdown"><span class="glyphicon glyphicon-lock"></span> <span class="caret"></span></a>
	            	<a href="javascript:void(0);" class="dropdown-toggle visible-xs" data-toggle="dropdown">Admin Options</a>
	            	<ul class="dropdown-menu">
	            		<li><a href="{{ URL::action('RaceController@index') }}">Races</a></li>
            			<li><a href="{{ URL::action('Sentinel\UserController@index') }}">Users</a></li>
            			<li><a href="{{ URL::action('Sentinel\GroupController@index') }}">Groups</a></li>
          			</ul>
	            </li>

	            @endif
				@if (Sentry::check())


				<li>
	            	<a href="javascript:void(0);" class="dropdown-toggle hidden-xs" data-toggle="dropdown">{{ Session::get('email') }} <span class="caret"></span></a>
	            	<a href="javascript:void(0);" class="dropdown-toggle visible-xs" data-toggle="dropdown">Account Options</a>
	            	<ul class="dropdown-menu">
	            		<li><a href="{{ URL::route('races.create') }}"></a></li>
            			<li {{ (Request::is('users/show/' . Session::get('userId')) ? 'class="active"' : '') }}><a href="{{ URL::action('Sentinel\UserController@show',Session::get('userId')) }}">My Account</a></li>
            			<li><a href="{{ URL::route('Sentinel\logout') }}">Logout</a></li>
          			</ul>
	            </li>
				@else
				<li {{ (Request::is('login') ? 'class="active"' : '') }}><a href="{{ URL::route('Sentinel\login') }}">Login</a></li>
				<li {{ (Request::is('users/create') ? 'class="active"' : '') }}><a href="{{ URL::route('Sentinel\register') }}">Register</a></li>
				@endif
	          </ul>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
		<!-- ./ navbar -->

		<!-- Container -->
		<div class="container">
			<!-- Notifications -->
			@include('layouts.notifications')
			<!-- ./ notifications -->

			<!-- Content -->
			@yield('content')
			<!-- ./ content -->
		</div>

		<!-- ./ container -->

		<!-- Javascripts
		================================================== -->
		<script src="{{ asset('packages/rydurham/sentinel/js/jquery-2.0.2.min.js') }}"></script>
		<script src="{{ asset('packages/rydurham/sentinel/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('packages/rydurham/sentinel/js/restfulizer.js') }}"></script>
		<!-- Thanks to Zizaco for the Restfulizer script.  http://zizaco.net  -->
	</body>
</html>
