@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myNotifications') }}">Notification</a></li>
            <li class="breadcrumb-item active" aria-current="page">Query Reply</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Query Reply</h4></div>
                    <div class="container" style="min-height: 400px;">
                        <div class="mt-5 p-3">
                            <h4 class="mt-3">Query</h4>
                            <p>{{$myQuery->body}}<p>
                            <p>Query Time: <span class="text-primary">{{$myQuery->created_at}}</span></p>
                            <div class="mt-5"></div>
                        </div>
                        <div class="mt-3 p-3">
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
