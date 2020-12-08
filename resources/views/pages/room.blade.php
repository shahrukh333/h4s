@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Rooms</li>
        </ol>
    </nav>
</div>
<div class="container" onload="hideAddRoomFields()">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Rooms</h4></div>
                <div class="card-body" style="min-height: 400px;">
                    @if(count($rooms) != 0)
                        @if(count($rooms) > 1)
                        <div class="container">
                        <div class="row">
                            @php 
                               $no = 0
                            @endphp
                            @foreach($rooms as $room)
                                <div class="col-md-4 col-sm-12">
                                    <a href="{{ url('getRoom',['id' => encrypt($room->id)]) }}">
                                        <div class="room rounded shadow mt-2" style = 'background-image: url("http://localhost/hostel4student/public//graphics/roomimage.jpg"); background-size: cover'>
                                            <h3 class="pt-4 text-center text-primary"><span class="badge badge-secondary">Room No {{$room->room_no}}</span></h3>
                                            <p class="text-center">Room Capacity<span class="bg-secondary rounded pr-1 pl-1">{{$room->capacity}}</span></p>
                                            <p class="text-center">Occupied  <span class="bg-secondary rounded pr-1 pl-1">{{$room->occupied}}</span></p>
                                            <p class="text-center">Room Rent <span class="bg-secondary rounded pr-1 pl-1">{{$room->rent}}</span></p>
                                            <p class="text-center pb-4 ml-4"><span class="badge badge-secondary">{{$room->capacity - $room->occupied}} seats available</span></p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-4 col-sm-12">
                                <a href="{{ url('getRoom',['id' => encrypt($rooms->first()->id)]) }}"> 
                                    <div class="room rounded shadow mt-2" style = 'background-image: url("http://localhost/hostel4student/public//graphics/roomimage.jpg"); background-size: cover'>
                                        <h3 class="pt-4 text-center text-primary"><span class="badge badge-secondary">Room No {{$rooms->first()->room_no}}</span></h3>
                                        <p class="text-center">Room Capacity<span class="bg-secondary rounded pr-1 pl-1">{{$rooms->first()->capacity}}</span></p>
                                        <p class="text-center">Occupied  <span class="bg-secondary rounded pr-1 pl-1">{{$rooms->first()->occupied}}</span></p>
                                        <p class="text-center">Room Rent <span class="bg-secondary rounded pr-1 pl-1">{{$rooms->first()->rent}}</span></p>
                                        <p class="text-center pb-4 ml-4 h5"><span class='badge badge-secondary'><span class="badge badge-secondary">{{$rooms->first()->capacity - $rooms->first()->occupied}} seats available</span></p>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <div class="clear" style="float:none"></div>
                    @else 
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>No rooms to show, please add room
                        </div>
                    @endif
                    <!-- Form to add rooms -->
                    <div class="container" style="clear:left">
                        <div class="row ml-2 mt-2">
                            <button class="btn btn-primary mt-4" id="myBtn" value="Show" onclick="hideAddRoomFields()">Add New Room<i class="fa fa-edit fa-lg ml-2"></i></button>
                        </div>
                        <div id="myForm">
                            <h4 class="pt-4 pb-2 text-info font-weight-bold">Basic Informations</h4>
                            <div class="row">
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label>Capacity</label>
                                        <select class="form-control" id="capacity">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Room Number</label>
                                        <input type="number" class="form-control" placeholder="enter room number" name="no">
                                        <span id="noSpan" class="text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label>Rent Per Month</label>
                                        <input type="number" class="form-control" placeholder="enter room rent per month" name="rent">
                                        <span id="rentSpan" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="pt-3 pb-2 text-info font-weight-bold">Room Facilities</h4>
                            <div class="row mt-2">            
                                <div class="col-md-2">                           
                                    <label>AC</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="ac">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>
                            
                                <div class="col-md-2">                         
                                    <label>Fan</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="fan">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>                     
                            </div>

                            <div class="row mt-3">            
                                <div class="col-md-2">                           
                                    <label>Attach Bath</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="attachWashroom">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>
                            
                                <div class="col-md-2">                         
                                    <label>Ventilation</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="ventilation">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>                     
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">                         
                                    <label>Wardrobe</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="wardrobe">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>            
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-2">                           
                                    <label>Other1*</label>
                                </div>
                                <div class="col-md-3">                          
                                    <input type="text" class="form-control" placeholder="addition facility" name="other1" />                         
                                </div>
                                <div class="col-md-2">                         
                                    <label>Other2*</label>
                                </div>
                                <div class="col-md-3">                          
                                    <input type="text" class="form-control" placeholder="additional facility" name="other2" />                           
                                </div>                     
                            </div>
                            <p class="text-primary mt-2">*Additional facility other than that mentioned above</p>

                            <input type="hidden" value="{{session('hostel')->id}}" name="hostelId"/>
                            <input type="hidden" value="{{Session::token()}}" name="token" />
                            <button id="addRoomBtn" class="btn btn-primary pl-4 pr-4">Add</button>
                            <button id="addRoomCancelBtn" class="btn btn-primary pl-4 pr-4">Cancel</button>
                            <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            <div id="success"></div>
                        </div>
                   </div>
                   <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

