@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Complaints</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">My Complaints</h4></div>
                <div class="card-body" style="min-height: 400px;">
                @if(count($complaints) > 0)
                    @if(count($complaints) > 1)
                        @foreach($complaints as $complaint)
                            <div class="container  p-3">
                                <div class="well mt-2">
                                    <h4 class="font-weight-bold">Complaint</h4>
                                    <p><span class="font-weight-bold">Hostel:</span> {{$info->getHostelName($complaint->hostel_id)}}</p>
                                    <p><span class="font-weight-bold">Issue:</span> {{$complaint->body}}</p>
                                    <p><span class="font-weight-bold">Complaint time:</span> {{$complaint->created_at}}</p>
                                    <p><span class="font-weight-bold">Status:</span> {{$complaint->status}}</p>
                                    <input type="hidden" value="{{Session::token()}}" name="token"/>
                                    @if($complaint->status == 'Pending')
                                        <a href="{{ url('/editComplaint',['id' => encrypt($complaint->id)]) }}" class="btn btn-primary">Edit<i class="fa fa-pencil fa-lg ml-2"></i></a>
                                    @else 
                                        <a class="btn btn-primary" href="{{url('getComReply', ['id' => encrypt($complaint->id)])}}">View Reply<i class="fa fa-eye fa-lg ml-2"></i></a>
                                    @endif
                                    <a href="{{ url('/deleteComplaint',['id' => encrypt($complaint->id)]) }}" class="btn btn-primary">Delete<i class="fa fa-trash fa-lg ml-2"></i></a>
                                </div>
                            </div>
                            <hr>
                            <div id="reply" class="container shadow mt-3"></div>
                        @endforeach
                    @else 
                        <div class="container p-3">
                            <div class="well mt-2">
                                <h4 class="font-weight-bold">Complaint</h4>
                                <p><span class="font-weight-bold">Hostel:</span> {{$info->getHostelName($complaints->first()->hostel_id)}}</p>
                                <p><span class="font-weight-bold">Issue:</span> {{$complaints->first()->body}}</p>
                                <p><span class="font-weight-bold">Complaint time:</span> {{$complaints->first()->created_at}}</p>
                                <p><span class="font-weight-bold">Status:</span> {{$complaints->first()->status}}</p>
                                <input type="hidden" value="{{Session::token()}}" name="token"/>
                                @if($complaints->first()->status == 'Pending')
                                    <a href="{{ url('/editComplaint',['id' => encrypt($complaints->first()->id)]) }}" class="btn btn-primary">Edit<i class="fa fa-pencil fa-lg ml-2"></i></a>
                                @else 
                                    <a class="btn btn-primary" href="{{url('getComReply', ['id' => encrypt($complaints->first()->id)])}}">View Reply<i class="fa fa-eye fa-lg ml-2"></i></a>
                                @endif
                                <a href="{{ url('/deleteComplaint',['id' => encrypt($complaints->first()->id)]) }}" class="btn btn-primary">Delete<i class="fa fa-trash fa-lg ml-2"></i></a>
                            </div>
                        </div>
                        <hr>
                        <div id="reply" class="container shadow mt-3"></div>
                    @endif
                @else 
                    <div class="pt-5 pb-5 h5 mt-5 text-center font-weight-bold">
                        <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There are no Complaint to show
                    </div>
                @endif
                <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
