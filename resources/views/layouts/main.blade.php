<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Car Service</title>

	<link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"> -->
	<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/> -->
	<link rel="stylesheet" href="{{ asset('/bower/fullcalendar/dist/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower/ng-tags-input/ng-tags-input.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower/AngularJS-Toaster/toaster.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/bower/angular-xeditable/dist/css/xeditable.css') }}">
	<!-- <link rel="stylesheet" href="{{ asset('/css/bootstrap-tagsinput.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/bootstrap-tagsinput-typeahead.css') }}"> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/balloon-css/0.5.0/balloon.min.css">
	<link rel="stylesheet" href="{{ asset('/css/main.css') }}">

	<!-- Fonts -->
	<!-- <link rel='stylesheet' href='//fonts.googleapis.com/css?family=Roboto:400,300' type='text/css'> -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="{{ asset('/bower/angular/angular.min.js') }}"></script>
	<script src="{{ asset('/bower/moment/moment.js') }}"></script>
	<script src="{{ asset('/bower/fullcalendar/dist/fullcalendar.min.js') }}"></script>
	<script src="{{ asset('/bower/fullcalendar/dist/locale/th.js') }}"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->
	<script src="{{ asset('/bower/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('/bower/ng-tags-input/ng-tags-input.min.js') }}"></script>
	<script src="{{ asset('/bower/angular-animate/angular-animate.min.js') }}"></script>
	<script src="{{ asset('/bower/AngularJS-Toaster/toaster.min.js') }}"></script>
	<script src="{{ asset('/bower/angular-xeditable/dist/js/xeditable.js') }}"></script>
	<script src="{{ asset('/bower/angular-modal-service/dst/angular-modal-service.min.js') }}"></script>
	<script src="{{ asset('/bower/underscore/underscore-min.js') }}"></script>
	<!-- <script src="{{ asset('/bower/axios/dist/axios.min.js') }}"></script> -->
	<!-- <script src="{{ asset('/js/bootstrap-tagsinput.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-tagsinput-angular.min.js') }}"></script> -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/highcharts-more.js"></script>
	
	<script src="{{ asset('/js/env.js') }}"></script>
	<script src="{{ asset('/js/main.js') }}"></script>
	<script src="{{ asset('/js/controllers/mainCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/reserveCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/assignCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/maintenanceCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/insuranceCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/taxCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/fuelCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/reportCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/driverCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/actCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/surveyCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/preparedCtrl.js') }}"></script>
	<script src="{{ asset('/js/controllers/vehicleCtrl.js') }}"></script>
	<script src="{{ asset('/js/directives/highcharts.js') }}"></script>
	<script src="{{ asset('/js/services/report.js') }}"></script>

</head>
<body ng-app="app" ng-controller="mainCtrl">

	<div class="app container-fluid">
		@extends('layouts.menu')

		<div class="container-fluid">
			<div class="content">

				@yield('content')

				<toaster-container></toaster-container>
				
			</div>
		</div>

		@extends('layouts.footer')
	</div>
	
</body>
</html>
