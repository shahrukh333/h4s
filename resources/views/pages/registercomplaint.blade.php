@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register Hostel Complaint</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Register Complaint</h4></div>
                <div class="container" style="min-height: 400px;">                  
                    <h4 class="ml-3 font-weight-bold mt-5">Register your complaint</h4>
                    <div class="container">
                        <div class="form-group">
                            <textarea class="form-control" rows="6" name="complaint" placeholder="please write your complaint"></textarea>
                            <span id="complaintSpan" class="text-danger"></span>
                        </div>
                        <input type="hidden" value="{{session('hostelId')}}" name="hostelId"/>
                        <input type="hidden" value="{{Auth::user()->id}}" name="userId" />
                        <input type="hidden" value="{{Session::token()}}" name="token" />
                        <button id="registerComplaintBtn" class="btn btn-primary shadow">Register Complaint<i class="fa fa-save fa-lg ml-2"></i></button>
                    </div>
                    <div id="success"></div>
                    <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

