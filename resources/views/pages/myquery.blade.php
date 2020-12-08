@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Queries</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">My Queries</h4></div>
                <div class="card-body" style="min-height: 400px;">
                @if(count($queries) > 0)
                    <input type="hidden" value="{{Session::token()}}" name="token"/>
                    @if(count($queries) > 1)
                        @foreach($queries as $query)
                            <div class="container p-3">
                                <div class="well mt-3">
                                    <p><span class="font-weight-bold">Query: </span>{{$query->body}}</p>
                                    <p class="mt-2"><span class="font-weight-bold">Query status:</span> {{$query->status}}</p>
                                    <p><span class="font-weight-bold">Query time: </span>{{$query->created_at}}</p>
                                    @if($query->status === 'Pending')
                                        <a href="{{ url('/editQuery',['id' => encrypt($query->id)]) }}" class="btn btn-primary">Edit<i class="fa fa-pencil fa-lg ml-2"></i></a>
                                    @else 
                                        <a class="btn btn-primary" href="{{url('getQueReply', ['id' => encrypt($query->id)])}}">View Reply<i class="fa fa-eye fa-lg ml-2"></i></a>
                                    @endif
                                    <a href="{{ url('/deleteQuery',['id' => encrypt($query->id)]) }}" class="btn btn-primary">Delete<i class="fa fa-trash fa-lg ml-2"></i></a>
                                </div>
                            </div>
                            <hr>
                            <div id="reply" class="container shadow mt-3"></div>
                        @endforeach
                    @else 
                        <div class="container p-3">
                            <div class="well mt-3">
                                <p><span class="font-weight-bold">Query: </span>{{$queries->first()->body}}</p>
                                <p class="mt-1"><span class="font-weight-bold">Query status:</span>{{$queries->first()->status}}</p>
                                <p><span class="font-weight-bold">Query time: </span>{{$queries->first()->created_at}}</p>
                                @if($queries->first()->status === 'Pending')
                                    <a href="{{ url('/editQuery',['id' => encrypt($queries->first()->id)]) }}" class="btn btn-primary">Edit<i class="fa fa-pencil fa-lg ml-2"></i></a>
                                @else 
                                <a class="btn btn-primary" href="{{url('getQueReply', ['id' => encrypt($queries->first()->id)])}}">View Reply<i class="fa fa-eye fa-lg ml-2"></i></a>
                                @endif
                                <a href="{{ url('/deleteQuery',['id' => encrypt($queries->first()->id)]) }}" class="btn btn-primary">Delete<i class="fa fa-trash fa-lg ml-2"></i></a>
                            </div>
                        </div>
                        <hr>
                        <div id="reply" class="container shadow mt-3"></div>
                    @endif
                @else 
                    <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                        <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>No queries to show
                    </div>
                @endif
                <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
