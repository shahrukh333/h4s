<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/icon" href="{{ url('graphics/favicon.png') }}"/>
    <!-- Bootstrap -->
	<link  href="{{ asset('css/searchcss/bootstrap.min.css') }}"    rel="stylesheet" />
	<!-- Main styles -->
	<link href="{{ asset('css/searchcss/style.css') }}"   rel="stylesheet" />
	
	<link  href="{{ asset('css/searchcss/ie.css') }}"   rel="stylesheet" />
	<!-- Font Awesome -->
	<link   href="{{ asset('css/searchcss/font-awesome.min.css') }}"  rel="stylesheet" />
	<!-- Jquery UI -->
	<link  href="{{ asset('css/searchcss/jquery-ui.css') }}"  rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/indexcss/font-awesome.min.css') }}" /> 

    <!--animate.css -->
    <link rel="stylesheet" href="{{ asset('css/indexcss/animate.css') }}" />

    <!--hover.css -->
    <link rel="stylesheet" href="{{ asset('css/indexcss/hover-min.css') }}">
    <!--owl.carousel.css -->
    <link rel="stylesheet" href="{{ asset('css/indexcss/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/indexcss/owl.theme.default.min.css') }}"/>

    <!-- range css-->
    <link rel="stylesheet" href="{{ asset('css/indexcss/jquery-ui.min.css') }}" />

    <!--bootstrap.min.css-->
    <link rel="stylesheet" href="{{ asset('css/indexcss/bootstrap.min.css') }}" />

    <!-- bootsnav -->
    <link rel="stylesheet" href="{{ asset('css/indexcss/bootsnav.css') }}"/>

    <!--style.css-->
    <link rel="stylesheet" href="{{ asset('css/indexcss/style.css') }}" />

    <!--responsive.css-->
    <link rel="stylesheet" href="{{ asset('css/indexcss/responsive.css') }}" />

    <!--font-family-->
    <link href="https://fonts.googleapis.com/css?family=Rufina:400,700" rel="stylesheet" />

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet" />

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    
</head>

<body>
    @include('includes.showsearchnavbar')
    <div>
        @yield('content')
        @include('includes.showsearchfooter')
    </div>
    @include('includes.searchshowjs')
</body>
</html>