@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hosteller Dues</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hosteller's Dues</h4></div>
                    <div class="container mt-3" style="min-height: 400px;">
                        @if($data != "")
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hosteller Name</th>
                                            <th>Room No<li class="fa fa-home ml-1"></li></th>
                                            <th>Payable(Rs)<li class="fa fa-money ml-1"></li></th>
                                            <th>Paid(Rs)<li class="fa fa-money ml-1"></li></th>
                                            <th>Pending(Rs)<li class="fa fa-money ml-1"></li></th>
                                            <th>Previous Balance(Rs)<li class="fa fa-money ml-1"></li></th>
                                            <th>Actions<li class="fa fa-hammer ml-1"></li></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    {!! $data !!} 
                                    </tbody>
                                </table> <!-- end of table -->
                            </div>
                            <p class="text-primary pt-2">*At the end of a month reset the dues data so that, the paid status will be zero</p>
                            <a id="notifyDefaultersBtn" href="{{ url('notifyDefaulters')}}" class="btn btn-primary">Notify Defaulters<i class="fa fa-bell fa-lg ml-2"></i></a>
                            <a id="resetDuesBtn" href="{{ url('resetDuesData')}}" class="btn btn-primary">Reset Dues<i class="fa fa-repeat fa-lg ml-2"></i></a>
                            <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                        @else 
                            <div class="font-weight-bold text-center mt-5 pt-5 pb-5 h5">
                                <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>No dues data to show, it seems there is no hosteller
                            </div>
                        @endif
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

