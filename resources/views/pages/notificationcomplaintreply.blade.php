@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myNotifications') }}">My Notification</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Complaint Reply</li>
        </ol>
    </nav>
</div> 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Complaint Reply</h4></div>
                    <div class="container" style="min-height: 400px">
                        <div class="mt-5">
                            <h4 class="mt-3">Coplaint</h4>
                            <p>{{$complaint->body}}<p>
                            <p>Complaint Time: <span class="text-primary">{{$complaint->created_at}}</span></p>
                            <div class="mt-5"></div>
                        </div>
                        <div class="mt-3 shadow p-3">
                            <h4 class="mt-3">Reply</h4>
                            <p>{{$reply->reply}}<p>
                            <p>Reply Time: <span class="text-primary">{{$reply->created_at}}</span></p>
                            <div class="mt-5"></div>
                        </div>
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
