@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Queries</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Queries</h4></div>
                <div class="card-body" style="min-height: 400px;">
                @if(count($queries) > 0)
                    @if(count($queries) > 1)
                        @foreach($queries as $query)
                            <div class="container p-3">
                                <div class="well mt-3">
                                    <p class="h5 font-weight-bold">Hosteller: <span class="text-primary">{{$user->getUserName($query->hosteller_id)}}</span></p>
                                    <p><span class="font-weight-bold">Query: </span>{{$query->body}}</p>
                                    <p><span class="font-weight-bold">Query status:</span> {{$query->status}}</p>
                                    <p><span class="font-weight-bold">Query time: </span>{{$query->created_at}}</span></p>
                                    <a href="{{ url('deleteHostellerQuery',['id' => encrypt($query->id)]) }}" class="btn btn-primary">Ignore<i class="fa fa-close fa-lg ml-2"></i></a>
                                    <a href="{{ url('showReplyQueryPage',['id' => encrypt($query->id)]) }}" class="btn btn-primary">Reply<i class="fa fa-reply fa-lg ml-2"></i></a>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else 
                        <div class="container p-3">
                            <div class="well mt-3">
                                <p class="h5 font-weight-bold">Hosteller: <span class="text-primary">{{$user->getUserName($queries->first()->hosteller_id)}}</span></p>
                                <p><span class="font-weight-bold">Query: </span>{{$queries->first()->body}}</p>
                                <p><span class="font-weight-bold">Query status:</span>{{$queries->first()->status}}</p>
                                <p><span class="font-weight-bold">Query time: </span>{{$queries->first()->created_at}}</span></p>
                                <a href="{{ url('deleteHostellerQuery',['id' => encrypt($queries->first()->id)]) }}" class="btn btn-primary">Ignore<i class="fa fa-close fa-lg ml-2"></i></a>
                                <a href="{{ url('showReplyQueryPage',['id' => encrypt($queries->first()->id)]) }}" class="btn btn-primary">Reply<i class="fa fa-reply fa-lg ml-2"></i></a>
                            </div>
                        </div>
                        <hr>
                    @endif
                    <div class="row col-md-12 col-sm-12 ml-1">
                        {!! $queries->appends(Request::all())->render()!!}
                    </div>
                @else 
                    <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                        <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There are no queries to show
                    </div>
                @endif
                <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
