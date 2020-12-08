@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Mess Menu</li>
        </ol>
    </nav>
</div> 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Add Mess Menu</h4></div> 
                    <div class="container" style="min-height: 400px;">
                        <div class="mt-5 pt-5 pb-5 h5">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>No mess menu to show, please add mess menu
                        </div>
                        <button class="btn btn-primary mt-2" id="breakfastBtn">Add Breakfast Menu<i class="fa fa-edit fa-lg ml-2"></i></button>
                        <button class="btn btn-primary mt-2 ml-2" id="lunchBtn">Add Lunch Menu<i class="fa fa-edit fa-lg ml-2"></i></button>
                        <button class="btn btn-primary mt-2 ml-2" id="dinnerBtn">Add Dinner Menu<i class="fa fa-edit fa-lg ml-2"></i></button>
                    
                            <div id="breakfast" class="container">
                                <h4 class="text-primary font-weight-bold mt-3">Breakfast Menu</h4>
                                <div class="form-group">
                                    <label>Monday</label>
                                    <textarea class="form-control" rows="1" name="bMonday" placeholder="enter monday menu"></textarea>
                                    <span id="bmSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Tuesday</label>
                                    <textarea class="form-control" rows="1" name="bTuesday" placeholder="enter tuesday menu"></textarea>
                                    <span id="btSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Wednesday</label>
                                    <textarea class="form-control" rows="1" name="bWednesday" placeholder="enter wednesday menu"></textarea>
                                    <span id="bwSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Thursday</label>
                                    <textarea class="form-control" rows="1" name="bThursday" placeholder="enter thursday menu"></textarea>
                                    <span id="bthSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Friday</label>
                                    <textarea class="form-control" rows="1" name="bFriday" placeholder="enter friday menu"></textarea>
                                    <span id="bfSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Saturday</label>
                                    <textarea class="form-control" rows="1" name="bSaturday" placeholder="enter saturday menu"></textarea>
                                    <span id="bstSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Sunday</label>
                                    <textarea class="form-control" rows="1" name="bSunday" placeholder="enter sunday menu"></textarea>
                                    <span id="bsSpan" class="text-danger"></span>
                                </div>
                                <input type="hidden" name="token" value="{{Session::token()}}"/>
                                <button id="addBreakfastBtn" class="btn btn-primary">Add Menu<i class="fa fa-save fa-lg ml-2"></i></button>
                            </div>
                            <div id="lunch" class="container">
                                <h4 class="text-primary font-weight-bold mt-3">Lunch Menu</h4>
                                <div class="form-group">
                                    <label>Monday</label>
                                    <textarea class="form-control" rows="1" name="lMonday" placeholder="enter monday menu"></textarea>
                                    <span id="lmSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Tuesday</label>
                                    <textarea class="form-control" rows="1" name="lTuesday" placeholder="enter tuesday menu"></textarea>
                                    <span id="ltSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Wednesday</label>
                                    <textarea class="form-control" rows="1" name="lWednesday" placeholder="enter wednesday menu"></textarea>
                                    <span id="lwSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Thursday</label>
                                    <textarea class="form-control" rows="1" name="lThursday" placeholder="enter thursday menu"></textarea>
                                    <span id="lthSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Friday</label>
                                    <textarea class="form-control" rows="1" name="lFriday" placeholder="enter friday menu"></textarea>
                                    <span id="lfSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Saturday</label>
                                    <textarea class="form-control" rows="1" name="lSaturday" placeholder="enter saturday menu"></textarea>
                                    <span id="lstSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Sunday</label>
                                    <textarea class="form-control" rows="1" name="lSunday" placeholder="enter sunday menu"></textarea>
                                    <span id="lsSpan" class="text-danger"></span>
                                </div>
                                <input type="hidden" value="{{Session::token()}}" name="token"/>
                                <button id="addLunchBtn" class="btn btn-primary">Add Menu<i class="fa fa-save fa-lg ml-2"></i></button>
                            </div>
                            <div id="dinner" class="container">
                                <h4 class="text-primary font-weight-bold mt-3">Dinner Menu</h4>
                                <div class="form-group">
                                    <label>Monday</label>
                                    <textarea class="form-control" rows="1" name="dMonday" placeholder="enter monday menu"></textarea>
                                    <span id="dmSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Tuesday</label>
                                    <textarea class="form-control" rows="1" name="dTuesday" placeholder="enter tuesday menu"></textarea>
                                    <span id="dtSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Wednesday</label>
                                    <textarea class="form-control" rows="1" name="dWednesday" placeholder="enter wednesday menu"></textarea>
                                    <span id="dwSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Thursday</label>
                                    <textarea class="form-control" rows="1" name="dThursday" placeholder="enter thursday menu"></textarea>
                                    <span id="dthSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Friday</label>
                                    <textarea class="form-control" rows="1" name="dFriday" placeholder="enter friday menu"></textarea>
                                    <span id="dfSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Saturday</label>
                                    <textarea class="form-control" rows="1" name="dSaturday" placeholder="enter saturday menu"></textarea>
                                    <span id="dstSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Sunday</label>
                                    <textarea class="form-control" rows="1" name="dSunday" placeholder="enter sunday menu"></textarea>
                                    <span id="dsSpan" class="text-danger"></span>
                                </div>
                                <input type="hidden" value="{{Session::token()}}" name="token"/>
                                <button id="addDinnerBtn" class="btn btn-primary">Add Menu<i class="fa fa-save fa-lg ml-2"></i></button>
                            </div>
                            <div id="success"></div>
                        <div class="mt-5"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


