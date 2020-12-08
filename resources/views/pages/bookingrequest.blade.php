@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Booking Requests</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Booking Requests</h4></div>
                <div class="card-body"  style="min-height: 400px;">
                    @if($data != "")
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email<i class='fa fa-envelope ml-1'></i></th>
                                        <th>Type</th>
                                        <th>Check in<i class='fa fa-calendar ml-1'></i></th>
                                        <th>Check out<i class='fa fa-calendar ml-1'></i></th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                {!! $data !!} 
                                </tbody>
                            </table> 
                            <input type="hidden" value="{{Session::token()}}" name="token"/>
                            <button id="checkAvailabilityBtn" class="btn btn-primary">Check Availability<li class="fa fa-eye fa-lg ml-1"></li></button>
                            <div id="success"></div>
                            <button id="checkAvailabilityCloseBtn" class="btn btn-primary mt-1">Close <li class="fa fa-close fa-lg"></li></button>
                        </div>
                    @else 
                        <div class="pt-5 pb-5 h5 mt-5 text-center font-weight-bold">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There are no requests to show
                        </div>
                    @endif
                    <div class="mt-2">
                        @include('includes.messages')
                    </div>
                    <div class="mt-5"></div>
                </div>
                </div>
            </div>
        </div>
</div>
@endsection
