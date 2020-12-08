@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Manage Booking</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Manage Booking</h4></div>
                    <div class="card-body" style="min-height: 400px;">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email<i class="fa fa-envelope ml-2"></i></th>
                                            <th>Hostel Name<i class="fa fa-room ml-2"></i></th>
                                            <th>Check in<i class="fa fa-calendar ml-2"></i></th>
                                            <th>Check out<i class="fa fa-calendar ml-2"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <td>{{Auth::user()->name}}</td>
                                        <td>{{Auth::user()->email}}</td>
                                        <td>{{$hostelName}}</td>
                                        <td>{{$booking->first()->check_in}}</td>
                                        <td>{{$booking->first()->check_out}}</td>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row col-md-12">
                                <button id="editBookingBtn" class="btn btn-primary mt-1">Edit Booking<i class="fa fa-wrench fa-lg ml-2"></i></button>
                                <button id="cancelBookingBtn" class="btn btn-primary mt-1 ml-1">Cancel Booking<i class="fa fa-trash fa-lg ml-2"></i></button>
                            </div>
                            <div id="cancelBookingAlert" class="row col-md-12 mt-3 ml-1 text-danger alert alert-danger" role="alert">
                                <h4 class="text-primary pl-3 font-weight-bold">Cancel Booking</h4>
                                <div class="col-md-12">
                                    <label>Enter checkout time</label>
                                    <input type="date" placeholder="enter check out date" name="cancelCheckout" class="form-control col-md-6" required>
                                    <span id="cancelCheckoutSpan" class="text-danger"></span>
                                </div>
                                <div class="col-md-12">
                                    Do you want to cancel your booking?
                                </div>
                                <div class="col-md-12 mt-2">
                                    <button id="cancelBookingNoBtn" class="btn btn-primary pl-4 pr-4">No</button>
                                    <button id="cancelBookingYesBtn" class="btn btn-primary pl-4 pr-4">Yes</button>
                                </div>
                            </div>
                            <div id="updateBookingForm" class="row col-md-12 mt-5">
                                <div class="col-md-12">
                                    <h4 class="text-primary font-weight-bold">Edit Booking</h4>
                                </div>
                                <div class="col-md-6">
                                    <label for="check_in">Check in date<i class="fa fa-calendar ml-2"></i></label>
                                    <input type="date" placeholder="enter check in date" name="checkin" class="form-control">
                                    <span id="checkinSpan" class="text-danger"></span>
                                </div>
                                <div class="col-md-6">
                                    <label for="check_out">Check out date<i class="fa fa-calendar ml-2"></i></label>
                                    <input type="date" placeholder="enter check out date" name="checkout" class="form-control">
                                    <span id="checkoutSpan" class="text-danger"></span>
                                </div>
                                <div class="row col-md-12 mt-3">
                                    <input type="hidden" name="bookingId" value="{{$booking->first()->id}}">
                                    <input type="hidden" name="token" value="{{Session::token()}}">
                                    <button id="updateBookingBtn" class="btn btn-primary ml-3">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                                </div>
                            </div>
                        </div>
                        <div id="success"></div>
                    </div>
                    <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

