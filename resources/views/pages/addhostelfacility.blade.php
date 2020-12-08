@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Facilities</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header"><h3 class="text-center">Hostel Facilites</h3></div> 
                    <div class="container" style="min-height: 400px;">
                    @if($added === false)
                        <div class="alert alert-danger mt-5" role="alert">
                            no facilities to show, please add hostel facilities
                        </div>                   
                        <h3 class="ml-3">Add Facilites</h3>
                        <form method="POST" action="{!! url('addHostelFacility') !!}">
                        <div class="container">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" rows="6" name="facility" placeholder="enter hostel facilites"></textarea>
                            </div>
                            <input type="hidden" value="{{encrypt(session('hostel')->id)}}" name="hostelId"/>
                            <input type="submit" class="btn btn-primary" value="Add Facility"/>
                            </div>
                        </form>
                    @else 
                        <div class="alert alert-success mt-5" role="alert">
                            hostel facilities successfully added
                        </div>
                    @endif
                        <div class="mt-5"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


