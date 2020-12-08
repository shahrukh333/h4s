@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('Mess') }}">Mess Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Dinner Menu</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Dinner Menu</h4></div>
                    <div class="container" style="min-height: 400px;">
                        <div class="container">
                            <div class="form-group mt-3">
                                <label>Monday</label>
                                <textarea class="form-control text-primary" rows="1" name="monday">{{$dinnerMenu->monday}}</textarea>
                                <span id="dmSpan" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Tuesday</label>
                                <textarea class="form-control text-primary" rows="1" name="tuesday">{{$dinnerMenu->tuesday}}</textarea>
                                <span id="dtSpan" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Wednesday</label>
                                <textarea class="form-control text-primary" rows="1" name="wednesday">{{$dinnerMenu->wednesday}}</textarea>
                                <span id="dwSpan" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Thursday</label>
                                <textarea class="form-control text-primary" rows="1" name="thursday">{{$dinnerMenu->thursday}}</textarea>
                                <span id="dthSpan" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Friday</label>
                                <textarea class="form-control text-primary" rows="1" name="friday">{{$dinnerMenu->friday}}</textarea>
                                <span id="dfSpan" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Saturday</label>
                                <textarea class="form-control text-primary" rows="1" name="saturday">{{$dinnerMenu->saturday}}</textarea>
                                <span id="dstSpan" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Sunday</label>
                                <textarea class="form-control text-primary" rows="1" name="sunday">{{$dinnerMenu->sunday}}</textarea>
                                <span id="dsSpan" class="text-danger"></span>
                            </div>
                            <input type="hidden" value="{{$dinnerMenu->id}}" name="dinnerId"/>
                            <input type="hidden" value="{{Session::token()}}" name="token"/>
                            <button id="editDinnerBtn" class="btn btn-primary">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                            <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
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
