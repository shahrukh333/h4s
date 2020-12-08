@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Leave Job</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Leave Job</h4></div>
                <div class="container mt-4" style="min-height: 400px">
                    <div class="row mt-4">
                        <div class="col-md-8 mx-auto">
                            <form action="{{ url('hostelManagerLeave') }}" method="POST">
                                @csrf
                                <p class="h5">It was great working you in {{session('hostelName')}}, <span class="text-danger">Are you sure you want to leave the job?</span></p>
                                <label class="mt-3" for="checkoutDate">Eneter leave date<li class="fa fa-calendar ml-2"></li></label>
                                <input type="date" name="leaveDate" class="form-control" placeholder="please etner the leave date"/>
                                <span id="leavedateSpan" class="text-danger"></span><br>
                                <button type="button" id="hostelLeaveValidateBtn" class="btn btn-primary mt-3">Next<li class="fa fa-angle-double-right fa-lg ml-1"></li></button>
                                <button type="submit" id="hostelManagerLeaveYesBtn" class="btn btn-primary mt-3">Send Leave Request<li class="fa fa-reply ml-2"></li></button>
                                <img id="myLoader" class="ml-2 mt-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            </form>
                            <div class="mt-2"></div>
                            @include('includes.messages')
                        </div>
                    </div>
                <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
