@extends('layouts.app')

@section('content')
@include('includes.sidenav')

@php 
 $found = false;
@endphp

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('hostelRoom') }}">Rooms</a></li>
            <li class="breadcrumb-item"><a href="{{ url('getRoom',['id' => encrypt($roomId)]) }}">Room {{$roomNo}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shift Hosteller</li>
        </ol>
    </nav>
</div>

<div class="container" onload="hideAddRoomFields()">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Shift Hosteller Room</h4></div>
                <div class="card-body" style="min-height: 400px;">
                    @if(count($rooms) > 0)
                        <h4 class="font-weight-bold pl-2 text-center text-primary">Please select a room</h4>
                        <div class="row">
                            @if(count($rooms) > 1)
                                @foreach($rooms as $room)
                                    @if($room->id != $roomId)
                                        <div id="shiftHostellerDiv" class="col-md-4 col-sm-12">
                                            <a href="{{ url('/changeHostellerRoom',[encrypt($room->id), encrypt($hostellerId)]) }}">
                                                <div class="room rounded shadow mt-4" style = 'background-image: url("http://localhost/hostel4student/public//graphics/roomimage.jpg"); background-size: cover'>
                                                    <h3 class="pt-4 text-center text-primary"><span class="badge badge-secondary">Room No {{$room->room_no}}</span></h3>
                                                    <p class="text-center">Room Capacity<span class="bg-secondary rounded pr-1 pl-1">{{$room->capacity}}</span></p>
                                                    <p class="text-center">Occupied<span class="bg-secondary rounded pr-1 pl-1">{{$room->occupied}}</span></p>
                                                    <p class="text-center">Room Rent <span class="bg-secondary rounded pr-1 pl-1">{{$room->rent}}</span></p>
                                                    <p class="text-center pb-4 ml-4"><span class="badge badge-secondary">{{$room->capacity - $room->occupied}} seat available</span></p>
                                                </div>
                                            </a>
                                        </div>
                                        @php 
                                            $found = true; 
                                        @endphp
                                    @endif
                                @endforeach
                            @else
                                @if($rooms->first()->id != $roomId)
                                    <div id="shiftHostellerDiv" class="col-md-4 col-sm-12">
                                        <a href="{{ url('/changeHostellerRoom',[encrypt($rooms->first()->id), encrypt($hostellerId)]) }}">
                                            <div class="room rounded shadow" style = 'background-image: url("http://localhost/hostel4student/public//graphics/roomimage.jpg"); background-size: cover'>
                                                <h3 class="pt-4 text-center text-primary"><span class="badge badge-primary">Room No {{$rooms->first()->room_no}}</span></h3>
                                                <p class="text-center">Room Capacity<span class="bg-primary rounded pr-1 pl-1">{{$rooms->first()->capacity}}</span></p>
                                                <p class="text-center">Occupied<span class="bg-primary rounded pr-1 pl-1">{{$rooms->first()->occupied}}</span></p>
                                                <p class="text-center">Room Rent <span class="bg-primary rounded pr-1 pl-1">{{$rooms->first()->rent}}</span></p>
                                                <p class="text-center pb-4 ml-4"><span class="badge badge-primary">{{$rooms->first()->capacity - $rooms->first()->occupied}} seat available</span></p>             
                                            </div>
                                        </a>
                                    </div>
                                    @php 
                                        $found = true; 
                                    @endphp
                                @endif
                            @endif
                        </div>
                        <div class="clear" style="float:none"></div>
                        <img id="myLoader" class="ml-2 mt-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                    @else 
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>Sorry no room is availabe, all rooms are occupied
                        </div>
                    @endif
                    @if(!$found)
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

