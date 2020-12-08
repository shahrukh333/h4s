@extends('layouts.app')
@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('getHostelManager') }}">Hostel Managers</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Hostel Manager</li>
        </ol>
    </nav>
</div> 
 
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-8">
            <div class="card">
                <div class="bg-mybg pt-2"><h4 class="text-primary font-weight-bold text-center">Add Hostel Manager</h4></div>
                <div class="card-body" style="min-height: 400px;">
                    <div style="margin-left: 15%">
                        <div class="form-group row">
                            <img style="margin-left: 30%" src="{{ url('graphics/usericon.png')}}" alt="image not found" width="100" height="100">
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-10 ml-3">
                                <label for="name" class="col-form-label">Manager Name</label>
                                <input id="name" type="text" placeholder="enter manager name" class="form-control" name="name"  required autofocus>
                                <span id="usernameSpan" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-10 ml-3">
                                <label for="email" class="col-form-label">Email Address<i class="fa fa-envelope fa-lg ml-2"></i></label>
                                <input id="email" type="email" placeholder="enter manager email address" class="form-control" name="email" required>
                                <span id="emailSpan" class="text-danger"></span>
                                <input id="type" type="hidden" name="type" value="M">
                                <input type="hidden" value="{{Session::token()}}" name="token" />
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-10 ml-3">
                            <label for="password" class="col-form-label">Password<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input id="password" type="password" placeholder="enter password" class="form-control" name="password" required>
                                <span id="passwordSpan" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-10 ml-3">
                                <label for="password-confirm" class="col-form-label">Confirm Password<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input id="password-confirm" type="password" placeholder="confirm password" class="form-control" name="password_confirmation" required>
                                <span id="confirmPassSpan" class="text-danger"></span>
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-10 ml-3">
                                <button id="hostelManagerAddBtn" class="btn btn-primary">add manager<i class="fa fa-user-plus fa-lg ml-2"></i></button>
                                <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div id="success"></div>
                    </div>
                    <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
