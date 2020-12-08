@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myQueries') }}">My Queries</a></li>
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
                        <div class="mt-2 p-3">
                            <h4 class="mt-3 font-weight-bold">Query</h4>
                            <p><span class="font-weight-bold">Query: </span>{{$myQuery->body}}<p>
                            <p><span class="font-weight-bold">Query time: </span>{{$myQuery->created_at}}</p>
                        </div>
                        <div class="p-3">
                            <h4 class="mt-2 font-weight-bold">Reply</h4>
                            @if(count($reply) > 0)
                                <p><p><span class="font-weight-bold">Reply: </span>{{$reply->first()->reply}}<p>
                                <p><span class="font-weight-bold">Reply time: </span>{{$reply->first()->created_at}}</p>
                            @else 
                                No reply, it seems your query has benn ignored
                            @endif
                        </div>
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
