@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/hostelRoom') }}">Rooms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Room No {{$room->room_no}}</li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Manage Room</h4></div>
                <div class="card-body w-70">
                    <div class="container">
                        <div class="row">
                            <button class="btn btn-primary mt-3" id="myBtn" value="Show" onclick="hideAddRoomFields()">Edit Room Details<i class="fa fa-pencil fa-lg ml-2"></i></button>
                        </div>
                        <div class="row" id="myForm">
                            <h4 class="mt-4 text-info font-weight-bold">Basic Informations</h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Capacity</label>
                                        <select class="form-control" name="capacity">
                                            <option value="{{$room->capacity}}" selected="selected">{{$room->capacity}}</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Rent Per Month</label>
                                        <input type="number" class="form-control" placeholder="enter room rent per month" value="{{$room->rent}}" name="rent">
                                        <span id="rentSpan" class="text-danger"></span>
                                    </div>
                                </div>
                            </div>
                            
                            <h4 class="mt-2 text-info font-weight-bold">Room Facilities</h4>
                            <div class="row mt-2">            
                                <div class="col-md-3">                           
                                    <label>AC</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="ac">
                                        <option value="{{$facilities->first()->ac}}">{{$facilities->first()->ac}}</option>                                        
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>
                            
                                <div class="col-md-3">                         
                                    <label>Fan</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="fan">
                                        <option value="{{$facilities->first()->fan}}">{{$facilities->first()->fan}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>                     
                            </div>

                            <div class="row mt-3">            
                                <div class="col-md-3">                           
                                    <label>Attach Bath</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="attachWashroom">
                                        <option value="{{$facilities->first()->attach_washroom}}">{{$facilities->first()->attach_washroom}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>
                            
                                <div class="col-md-3">                         
                                    <label>Ventilation</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="ventilation">
                                        <option value="{{$facilities->first()->ventilation}}">{{$facilities->first()->ventilation}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>                     
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">                         
                                    <label>Wardrobe</label>
                                </div>
                                <div class="col-md-3">                          
                                    <select class="form-control" name="wardrobe">
                                        <option value="{{$facilities->first()->wardrobe}}">{{$facilities->first()->wardrobe}}</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>                            
                                </div>           
                                
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">                           
                                    <label>Other1*</label>
                                </div>
                                <div class="col-md-3">
                                    @if($facilities->first()->other_1 == null)                          
                                        <input type="text" class="form-control" placeholder="addition facility" name="other1" /> 
                                    @else 
                                        <input type="text" class="form-control" value="{{$facilities->first()->other_1}}" name="other1" />                                        
                                    @endif
                                </div> 
                                <div class="col-md-3">                         
                                    <label>Other2*</label>
                                </div>
                                <div class="col-md-3">
                                    @if($facilities->first()->other_2 == null)                  
                                        <input type="text" class="form-control" placeholder="additional facility" name="other2" />
                                    @else 
                                        <input type="text" class="form-control" value="{{$facilities->first()->other_2}}" name="other2" />
                                    @endif
                                </div>                     
                            </div>
                            <p class="text-primary mt-2">*Additional facility other than that mentioned above</p>

                            <input type="hidden" value="{{$facilities->first()->id}}" name="facilityId"/>
                            <input type="hidden" value="{{$room->id}}" name="roomId" />
                            <input type="hidden" value="{{Session::token()}}" name="token" />
                            <button id="updateRoomBtn" class="btn btn-primary">Update</button>
                            <button id="updateRoomCancelBtn" class="btn btn-primary pr-4 pl-4 ml-1">Cancel</button>
                            <div id="success"></div>
                        </div>
                    </div>
                        <h4 class="pt-5 text-primary font-weight-bold">Occupants</h4>
                        @if($data != "")
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hosteller Name</th>
                                            <th>Email<i class="fa fa-envelope ml-2"></i></th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {!! $data !!}
                                    </tbody>
                                </table>
                            </div>
                        @else 
                            <div class="mt-3 font-weight-bold pt-5 pb-5 h5">
                                <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>The room is unoccupied
                                <hr>
                            </div> {{-- 
                            <a href="{{ url('BookingRequest') }}" class="btn btn-primary">add hosteller<i class="fa fa-user fa-lg ml-2"></i></a> --}}
                        @endif
                        @include('includes.messages')
                        <div>
                            @if($room->capacity > $room->occupied)
                                <button class="btn btn-primary mt-3 ml-1" id="addHostellerBtn">Add New Hosteller<i class="fa fa-user-plus fa-lg ml-2"></i></button>
                            @endif
                            <button class="btn btn-primary mt-3 pl-3 pr-3" id="hostelRoomRemoveBtn">Remove Room<i class="fa fa-trash fa-lg ml-2"></i></button>
                        </div>
                        <div id="addHostellerForm">
                            <h4 class="text-primary pt-3 pl-3 font-weight-bold">Add Hosteller</h4>
                            <div class="form-group row col-md-12">
                                <div class="col-md-10">
                                    <label for="name" class="col-form-label">Hosteller Name</label>
                                    <input id="name" type="text" placeholder="enter hosteller name" class="form-control col-md-10" name="name"  required autofocus>
                                    <span id="usernameSpan" class="text-danger"></span>
                                </div>
                            </div>
    
                            <div class="form-group row col-md-12">
                                <div class="col-md-10">
                                    <label for="email" class="col-form-label">Email Address<i class="fa fa-envelope ml-2"></i></label>
                                    <input id="email" type="email" placeholder="enter hosteller email address" class="form-control col-md-10" name="email" required>
                                    <span id="emailSpan" class="text-danger"></span>
                                    <input type="hidden" value="{{Session::token()}}" name="token" />
                                </div>
                            </div>
    
                            <div class="form-group row col-md-12">
                                <div class="col-md-10">
                                <label for="password" class="col-form-label">Password<i class="fa fa-unlock-alt ml-2"></i></label>
                                    <input id="password" type="password" placeholder="enter password" class="form-control col-md-10" name="password" required>
                                    <span id="passwordSpan" class="text-danger"></span>
                                </div>
                            </div>
    
                            <div class="form-group row col-md-12">
                                <div class="col-md-10">
                                    <label for="password-confirm" class="col-form-label">Confirm Password<i class="fa fa-unlock-alt ml-2"></i></label>
                                    <input id="password-confirm" type="password" placeholder="confirm password" class="form-control col-md-10" name="password_confirmation" required>
                                    <span id="confirmPassSpan" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-10">
                                    <label for="name" class="col-form-label">Checked in date<i class="fa fa-calendar ml-2"></i></label>
                                    <input type="date" placeholder="select checked in date" class="form-control col-md-10" name="checkin"  required autofocus>
                                    <span id="checkinSpan" class="text-danger"></span>
                                </div>
                            </div>
                            <div class="form-group row col-md-12">
                                <div class="col-md-10">
                                    <label for="name" class="col-form-label">Check out date<i class="fa fa-calendar ml-2"></i></label>
                                    <input type="date" placeholder="select checkout date" class="form-control col-md-10" name="checkout"  required autofocus>
                                    <span id="checkoutSpan" class="text-danger"></span>
                                </div>
                            </div>
                            <button class="btn btn-primary pl-4 pr-4 ml-3" id="romateAddBtn">Add </button>
                            <button id="addHostellerCancelBtn" class="btn btn-primary pl-4 pr-4">Cancel</button>
                            <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            <div id="hostellerSuccess"></div>
                            <hr>
                        </div>
                        
                        <div id="hostelRoomDeleteAlert" class="alert alert-danger text-danger mt-2" role="alert">
                            <p>Are you sure you want to delete room?</p>
                            <input type="hidden" name="roomId" value="{{$room->id}}"/>
                            <input type="hidden" name="token" value="{{Session::token()}}"/>
                            <button class="btn btn-primary pl-4 pr-4" id="hostelRoomDeleteAlertNo">No</button>
                            <button id="hostelRoomDeleteAlertYes" class="btn btn-primary pl-4 pr-4">Yes</button>
                        </div>
                        <div id="success2"></div>

                    </div>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>
</div>
@endsection

