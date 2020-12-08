@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/BookingRequest') }}">Booking Requests</a></li>
            <li class="breadcrumb-item active" aria-current="page">Accept Booking Request</li>
        </ol>
    </nav>
</div>

<div class="container" onload="hideAddRoomFields()">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Accept Booking Request</h4></div>
                <div class="card-body" style="min-height: 400px">
                    @if(count($rooms) > 0)
                        <h4 class="font-weight-bold text-center text-primary mt-2">Please select a room</h4>
                        <div class="row">
                            @if(count($rooms) > 1) 
                                @foreach($rooms as $room)
                                    <div id="acceptBookingDiv" class="col-md-4 col-sm-12">
                                        <a href="{{ url('addHosteller',[encrypt($room->id), encrypt($request->id)]) }}">
                                            <div class="room rounded shadow mt-4" style = 'background-image: url("http://localhost/hostel4student/public//graphics/roomimage.jpg"); background-size: cover'>
                                                <h3 class="pt-4 text-center text-primary"><span class="badge badge-secondary">Room No {{$room->room_no}}</span></h3>
                                                <p class="text-center">Room Capacity<span class="badge badge-primary">{{$room->capacity}}</span></p>
                                                <p class="text-center">Occupied<span class="badge badge-primary ml-2">{{$room->occupied}}</span></p>
                                                <p class="text-center">Room Rent <span class="badge badge-primary">{{$room->rent}}</span></p>
                                                <p class="text-center pb-4 ml-4"><span class="badge badge-secondary">{{$room->capacity - $room->occupied}} seats available</span></p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            @else
                                <div id="acceptBookingDiv" class="col-md-4 col-sm-12"> 
                                    <a href="{{ url('addHosteller',[encrypt($rooms->first()->id), encrypt($request->id)]) }}">
                                        <div class="room rounded shadow" style = 'background-image: url("http://localhost/hostel4student/public//graphics/roomimage.jpg"); background-size: cover'>
                                            <h3 class="pt-4 text-center text-primary"><span class="badge badge-secondary">Room No {{$rooms->first()->room_no}}</span></h3>
                                            <p class="text-center">Room Capacity<span class="badge badge-primary ml-2">{{$rooms->first()->capacity}}</span></p>
                                            <p class="text-center">Occupied<span class="badge badge-primary ml-2">{{$rooms->first()->occupied}}</span></p>
                                            <p class="text-center">Room Rent <span class="badge badge-primary ml-2">{{$rooms->first()->rent}}</span></p>
                                            <p class="text-center pb-4 ml-4"><span class="badge badge-secondary">{{$rooms->first()->capacity - $rooms->first()->occupied}} seats available</span></p>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                        <div class="clear" style="float:none"></div>
                    @else 
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>Sorry no room is availabe, all rooms are occupied
                        </div>
                    @endif
                </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>

function addHostelRoom()
{
    var capacity = $('#capacity').val();
    var rent = $('input[name = rent]').val();
    var hostelId = $('input[name = hostelId]').val();
    var facilities = $('textarea[name = facility]').val();
    var token = "{{Session::token()}}";
    var error = false;
    if(rent === '')
    {
        $('#rentSpan').html('please enter room rent');
        error = true;
    }

    if(facilities === '')
    {
        $('#facSpan').html('please enter room facilities');
        error = true;
    }

    if(error == false)
    {
        $.post("{{ url('addRoom') }}",{facilities:facilities, hostelId:hostelId, capacity:capacity, rent:rent, _token:token}, function(data){
            alert('Room added successfully');
        });
    }
   
}
</script>
