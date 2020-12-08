<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/icon" href="{{ url('graphics/favicon.png') }}"/>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/custom.js') }}" defer></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/myStyle.css') }}" rel="stylesheet">
    
</head>

<body onload="test()">

    @include('includes.navbar')
    <div id="app">
        <main class="py-4">
            @yield('content')

            @yield('scripts')
        </main>
    @include('includes.footer')
    </div>

</body>
<script>
     var url_editHostelInformation = "{{route('updateHostelInformation')}}";
     var url_addRoom = "{{route('addRoom')}}";
     var url_updateRoom = "{{route('updateRoomDetail')}}";
     var url_registerQuery = "{{route('registerHostelQuery')}}";
     var url_updateQuery = "{{route('updateQuery')}}";
     var url_registerComplaint = "{{route('registerComplaint')}}";
     var url_replyQuery = "{{route('replyQuery')}}";
     var url_editComplaint = "{{route('updateComplaint')}}";
     var url_getComplaintReply = "{{route('getComplaintReply')}}";
     var url_getQueryReply = "{{route('getQueryReply')}}";
     var url_getHostelData = "{{route('getHostelData')}}";
     var url_registerHostel = "{{route('registerHostel')}}";
     var url_addHostelRule = "{{route('addHostelRule')}}";
     var url_updateHostelRule = "{{route('updateRules')}}";
     var url_updateHostellerDues = "{{route('updateHostellerDues')}}";
     var url_updateHostelFacilities = "{{route('updateHostelFacilities')}}";
     var url_addHostelManager = "{{route('registerManager')}}";
     var url_updateBooking = "{{route('updateBooking')}}";
     var url_cancelBooking = "{{route('cancelBooking')}}";
     var url_registerHostelReview = "{{route('registerHostelReview')}}";
     var url_updateReview = "{{route('updateReview')}}";
     var url_validateUser = "{{route('validateUser')}}"; 
     var url_removeRoom = "{{route('removeHostelRoom')}}";
     var url_addBreakfastMenu = "{{route('addBreakfastMenu')}}";
     var url_addLunchMenu = "{{route('addLunchMenu')}}";
     var url_addDinnerMenu = "{{route('addDinnerMenu')}}";
     var url_updateBreakfastMenu = "{{route('updatebreakfast')}}";
     var url_updateLunchMenu = "{{route('updatelunch')}}";
     var url_updateDinnerMenu = "{{route('updatedinner')}}";
     var url_replyComplaint = "{{route('replyComplaint')}}";
     var url_addHosteller = "{{route('addHosteller')}}";
     var url_getRoomStatus = "{{route('getRoomStatus')}}";
</script>
<script src="{{ asset('js/custom.js') }}" defer></script>
</html>
