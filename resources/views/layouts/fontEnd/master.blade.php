<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }} </title>

    <!-- Scripts -->


    	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<!-- Stylesheets -->

	<link href="{{ asset('fontEnd/css/bootstrap.css')}}" rel="stylesheet">

	<link href="{{ asset('fontEnd/css/ionicons.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


	@stack('css')


</head>
<body >

@include('layouts.fontEnd.partial.header')

@yield('content')


@include('layouts.fontEnd.partial.footer')


	<!-- SCIPTS -->

	<script src="{{ asset('fontEnd/js/jquery-3.1.1.min.js')}}"></script>

	<script src="{{ asset('fontEnd/js/tether.min.js')}}"></script>

	<script src="{{ asset('fontEnd/js/bootstrap.js')}}"></script>
    <script src="{{ asset('fontEnd/js/swiper.js') }}"></script>
	<script src="{{ asset('fontEnd/js/scripts.js')}}"></script>
	<script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error(' {{ $error }}', 'Error',{
                  closeButton: true,
                  progressBar: true,
                });           
            @endforeach
        @endif
    </script>
@stack('js')
</body>
</html>
