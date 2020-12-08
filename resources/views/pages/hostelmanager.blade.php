@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hostel Manager</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Managers</h4></div>
                    <div class="container mt-4" style="min-height: 400px">
                        @if($data != "")
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Manager Name</th>
                                            <th>Manager Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {!! $data !!}
                                    </tbody>
                                </table>
                            </div>
                             <div id="hostelManagerDeleteAlert" class="alert alert-danger text-danger" role="alert">
                                <p>Are you sure you want to delete hostel manager?</p>
                                <button class="btn btn-primary pl-4 pr-4" id="hostelManagerDeleteAlertNo">No</button>
                                <a id="deleteHostelManagerLink" href="#" class="btn btn-primary pl-4 pr-4">Yes</a>
                            </div> 
                        @else 
                            <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                                <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>hostel manager not found
                            </div>
                        @endif
                        <a href="{{ url('addhostelmanager') }}" class="btn btn-primary">Add New Manager<i class="fa fa-user-plus fa-lg ml-2"></i></a>
                        <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                        <div class="mt-2"></div>
                        @include('includes.messages')
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
