@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hostel Mess Menu</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="min-height: 400px">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Mess Menu</h4></div>
                    <div class="container mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                @if(count($mess) > 0)
                                    <thead>
                                        <tr>
                                            <th scope="col">Days</th>
                                            <th scope="col">Monday</th>
                                            <th scope="col">Tuesday</th>
                                            <th scope="col">Wednesday</th>
                                            <th scope="col">Thursday</th>
                                            <th scope="col">Friday</th>
                                            <th scope="col">Saturday</th>
                                            <th scope="col">Sunday</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">Breakfast</th>
                                            @if($breakfast != null)
                                                <td>{{$breakfast->monday}}</td>
                                                <td>{{$breakfast->tuesday}}</td>
                                                <td>{{$breakfast->wednesday}}</td>
                                                <td>{{$breakfast->thursday}}</td>
                                                <td>{{$breakfast->friday}}</td>
                                                <td>{{$breakfast->saturday}}</td>
                                                <td>{{$breakfast->sunday}}</td>
                                            @else 
                                                <td colspan="7">breakfast menu not added</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th scope="row">Lunch</th>
                                            @if($lunch != null)
                                                <td>{{$lunch->monday}}</td>
                                                <td>{{$lunch->tuesday}}</td>
                                                <td>{{$lunch->wednesday}}</td>
                                                <td>{{$lunch->thursday}}</td>
                                                <td>{{$lunch->friday}}</td>
                                                <td>{{$lunch->saturday}}</td>
                                                <td>{{$lunch->sunday}}</td>
                                            @else 
                                                <td colspan="7">lunch menu not added</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th scope="row">Dinner</th>
                                            @if($dinner != null)
                                                <td>{{$dinner->monday}}</td>
                                                <td>{{$dinner->tuesday}}</td>
                                                <td>{{$dinner->wednesday}}</td>
                                                <td>{{$dinner->thursday}}</td>
                                                <td>{{$dinner->friday}}</td>
                                                <td>{{$dinner->saturday}}</td>
                                                <td>{{$dinner->sunday}}</td>
                                            @else 
                                                <td colspan="7">dinner menu not added</td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="mt-3 ml-2 text-primary">If you have any issue regarding the mess menu please leave us a complaint</p>
                            <a href="{{ url('hostelComplaint') }}" class="btn btn-primary ml-2">Register Complaint<i class="fa fa-edit fa-lg ml-2"></i></a>
                        @else 
                            <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                                <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>Mess Menu is not defined
                            </div>
                        @endif
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
