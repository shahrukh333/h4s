@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Hostel Dues</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">My Hostel Dues</h4></div>
                    <div class="container mt-5" style="min-height: 400px;">
                        @if(count($dues) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hosteller Name</th>
                                            <th>Payable(Rs)</th>
                                            <th>Paid(Rs)</th>
                                            <th>Pending(Rs)</th>
                                            <th>Previous Balance(Rs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$name}}</td>
                                            <td>{{$dues->first()->payable}}</td>
                                            <td>{{$dues->first()->paid}}</td>
                                            <td>{{$dues->first()->pending}}</td>
                                            <td>{{$dues->first()->previous_balance}}</td>
                                    </tbody>
                                </table> <!-- end of table -->
                                <p class="mt-3 ml-2 text-primary">If you have any issue regarding your hostel dues details please leave us a complaint</p>
                                <a href="{{ url('hostelComplaint') }}" class="btn btn-primary ml-2">Register Complaint<i class="fa fa-edit fa-lg ml-2"></i></a>
                            </div>
                        @else 
                            <div class="alert alert-danger mt-5" role="alert">
                                No dues data to show 
                            </div>
                        @endif
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

