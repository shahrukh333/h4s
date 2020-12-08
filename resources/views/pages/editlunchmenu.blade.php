@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('Mess') }}">Mess Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Lunch Menu</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Lunch Menu</h4></div> 
                    <div class="container" style="min-height: 400px;">
                        @if($lunchMenu != null)
                            <div class="container">
                                <div class="form-group mt-3">
                                    <label>Monday</label>
                                    <textarea class="form-control text-primary" rows="1" name="monday">{{$lunchMenu->monday}}</textarea>
                                    <span id="lmSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Tuesday</label>
                                    <textarea class="form-control text-primary" rows="1" name="tuesday">{{$lunchMenu->tuesday}}</textarea>
                                    <span id="ltSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Wednesday</label>
                                    <textarea class="form-control text-primary" rows="1" name="wednesday">{{$lunchMenu->wednesday}}</textarea>
                                    <span id="lwSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Thursday</label>
                                    <textarea class="form-control text-primary" rows="1" name="thursday">{{$lunchMenu->thursday}}</textarea>
                                    <span id="lthSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Friday</label>
                                    <textarea class="form-control text-primary" rows="1" name="friday">{{$lunchMenu->friday}}</textarea>
                                    <span id="lfSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Saturday</label>
                                    <textarea class="form-control text-primary" rows="1" name="saturday">{{$lunchMenu->saturday}}</textarea>
                                    <span id="lstSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Sunday</label>
                                    <textarea class="form-control text-primary" rows="1" name="sunday">{{$lunchMenu->sunday}}</textarea>
                                    <span id="lsSpan" class="text-danger"></span>
                                </div>
                                <input type="hidden" value="{{$lunchMenu->id}}" name="lunchId"/>
                                <input type="hidden" value="{{Session::token()}}" name="token"/>
                                <button id="editLunchMenuBtn" class="btn btn-primary">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                                <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            </div>
                            <div id="success"></div>
                        @else 
                            <div class="alert alert-success mt-5" role="alert">
                                Lunch updated successfully
                            </div>
                        @endif
                    <div class="mt-5"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
