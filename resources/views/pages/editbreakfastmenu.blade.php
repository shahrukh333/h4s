@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('Mess') }}">Mess Menu</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Breadfast Menu</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Breakfast Menu</h4></div>
                    <div class="container" style="min-height: 400px;">
                      @if($breakfastMenu != null)
                            <div class="container">
                                <div class="form-group mt-3">
                                    <label>Monday</label>
                                    <textarea class="form-control text-primary" rows="1" name="monday">{{$breakfastMenu->monday}}</textarea>
                                    <span id="bmSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Tuesday</label>
                                    <textarea class="form-control text-primary" rows="1" name="tuesday">{{$breakfastMenu->tuesday}}</textarea>
                                    <span id="btSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Wednesday</label>
                                    <textarea class="form-control text-primary" rows="1" name="wednesday">{{$breakfastMenu->wednesday}}</textarea>
                                    <span id="bwSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Thursday</label>
                                    <textarea class="form-control text-primary" rows="1" name="thursday">{{$breakfastMenu->thursday}}</textarea>
                                    <span id="bthSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Friday</label>
                                    <textarea class="form-control text-primary" rows="1" name="friday">{{$breakfastMenu->friday}}</textarea>
                                    <span id="bfSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Saturday</label>
                                    <textarea class="form-control text-primary" rows="1" name="saturday">{{$breakfastMenu->saturday}}</textarea>
                                    <span id="bstSpan" class="text-danger"></span>
                                </div>
                                <div class="form-group">
                                    <label>Sunday</label>
                                    <textarea class="form-control text-primary" rows="1" name="sunday">{{$breakfastMenu->sunday}}</textarea>
                                    <span id="bsSpan" class="text-danger"></span>
                                </div>
                                <input type="hidden" value="{{$breakfastMenu->id}}" name="breakfastId"/>
                                <input type="hidden" value="{{Session::token()}}" name="token"/>
                                <button id="updateBreakfastMenuBtn" class="btn btn-primary">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                                <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            </div>
                            <div id="success"></div> 
                      @else 
                        <div class="alert alert-success mt-5" role="alert">
                            Breakfast successfully updated
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
