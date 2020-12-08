@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item"><a href="{!! url('myQueries') !!}">My Queries</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Query</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Query</h4></div>
                    <div class="container shadow p-3" style="min-height: 400px">
                        <div class="container">
                            <h4 class="mt-5 font-weight-bold">My Query</h4>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="query">{{$query->body}}</textarea>
                                <span class="text-danger" id="querySpan"></span>
                            </div>
                            <input type="hidden" value="{{$query->id}}" name="queryId"/>
                            <input type="hidden" value="{{Session::token()}}" name="token"/>
                            <button id="editQueryBtn" class="btn btn-primary pl-4 pr-4">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                        </div>
                        <div id="success"></div>
                        <div class="mt-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


