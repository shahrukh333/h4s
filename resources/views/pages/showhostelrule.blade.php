@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Hostel Rules</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="min-height: 400px">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Rules</h4></div>
                    @if(count($hostelRules) > 0)
                        <div class="container mt-2">
                            <table class="table table-bordered mt-3">
                                <thead>
                                    <tr>
                                        <th>Rules</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @if($hostelRules->first()->rule_1 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_1}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_2 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_2}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_3 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_3}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_4 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_4}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_5 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_5}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_6 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_6}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_7 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_7}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_8 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_8}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_9 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_9}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_10 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_10}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_11 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_11}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_12 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_12}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_13 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_13}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_14 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_14}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_15 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_15}}</td>
                                </tr>
                            @endif
                                    </tbody>
                                </table>
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mt-2 text-primary">If you have any issue regarding the hostel rules please leave us a complaint</p>
                                    <a href="{{ url('hostelComplaint') }}" class="btn btn-primary">Register Complaint<i class="fa fa-edit fa-lg ml-2"></i></a>
                                </div>
                            </div>
                        </div>
                    @else 
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>Hostel rules are not defined
                        </div>
                    @endif
                <div class="mt-5"></div> 
        </div>
    </div>
</div>
@endsection
