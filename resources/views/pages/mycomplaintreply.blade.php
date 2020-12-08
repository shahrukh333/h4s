@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myComplaints') }}">My Complaints</a></li>
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
                        <div class="mt-2 p-3">
                            <h4 class="mt-3 font-weight-bold">Coplaint</h4>
                            <p><span class="font-weight-bold">Issue</span> {{$complaint->body}}<p>
                            <p><span class="font-weight-bold">Complaint time:</span> <span class="text-primary">{{$complaint->created_at}}</span></p>
                            <div class="mt-5"></div>
                        
                            <h4 class="mt-3 font-weight-bold">Reply</h4>
                            @if(count($reply) > 0)
                                <p><span class="font-weight-bold">Reply</span> {{$reply->first()->reply}}<p>
                                <p><span class="font-weight-bold">Reply Time:</span> <span class="text-primary">{{$reply->first()->created_at}}</span></p>
                            @else 
                                <p>No reply, it seems your complaint has been ignored<p>
                            @endif
                            <div class="mt-5"></div>
                        </div>
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
