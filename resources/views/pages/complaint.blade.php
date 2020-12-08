@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Complaints</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Complaints</h4></div>
                <div class="card-body" style="min-height: 400px;">
                @if(count($complaints) > 0)
                    @if(count($complaints) > 1)
                        @foreach($complaints as $complaint)
                            <div class="container p-3">
                                <div class="well mt-2">
                                    <h4 class="font-weight-bold">Complaint</h4>
                                    <p><span class="font-weight-bold">Hosteller</span> {{$user->getUserName($complaint->hosteller_id)}}</p>
                                    <p><span class="font-weight-bold">Issue</span> {{$complaint->body}}</p>
                                    <p><span class="font-weight-bold">Complaint time</span> {{$complaint->created_at}}</p>
                                    <a href="{{ url('updateComplaints',['id' => encrypt($complaint->id)]) }}" class="btn btn-primary">Ignore<i class="fa fa-close fa-lg ml-2"></i></a>
                                    <a href="{{ url('replycomplaints',['id' => encrypt($complaint->id)]) }}" class="btn btn-primary">Reply<i class="fa fa-reply fa-lg ml-2"></i></a>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else 
                        <div class="container p-3">
                            <div class="well mt-2">
                                <h4 class="font-weight-bold">Complaint</h4>
                                <p><span class="font-weight-bold">Hosteller</span> {{$user->getUserName($complaints->first()->hosteller_id)}}</p>
                                <p><span class="font-weight-bold">Issue</span> {{$complaints->first()->body}}</p>
                                <p><span class="font-weight-bold">Complaint time</span> {{$complaints->first()->created_at}}</p>
                                <a href="{{ url('/updateComplaints',['id'=> encrypt($complaints->first()->id)]) }}" class="btn btn-primary">Ignore<i class="fa fa-close fa-lg ml-2"></i></a>
                                <a href="{{ url('replycomplaints',['id' => encrypt($complaints->first()->id)]) }}" class="btn btn-primary">Reply<i class="fa fa-reply fa-lg ml-2"></i></a>
                            </div>
                        </div>
                        <hr>
                    @endif
                    <div class="row col-md-12 col-sm-12 ml-1">
                        {!! $complaints->appends(Request::all())->render()!!}
                    </div>
                @else 
                    <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                        <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There are no complaints to show
                    </div>
                @endif
                <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
