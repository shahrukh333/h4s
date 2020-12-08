@extends('layouts.app')

@section('content')

@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('Query') }}">Queries</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reply Query</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Reply Query</h4></div>
                <div class="card-body" style="min-height: 400px;">
                    <div class="container">
                        <h4 class="mt-3 font-weight-bold">Query</h4>
                        <div class="row mt-2 ml-1">
                            {{$query->body}}
                        </div>
                        <h4 class="mt-3 font-weight-bold">Reply</h4>
                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="reply" placeholder="please enter reply"></textarea>
                            <span id="replySpan" class="text-danger"></span>
                        </div>
                        <input type="hidden" value="{{$query->id}}" name="queryId"/>
                        <input type="hidden" value="{{Session::token()}}" name="token"/>
                        <button class="btn btn-primary" id="queryReplyBtn">Send Reply<i class="fa fa-reply fa-lg ml-2"></i></button>
                        <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                    </div>
                    <div id="success"></div>
                    <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
