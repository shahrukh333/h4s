@extends('layouts.app')

@section('content')

@include('includes.bsidenav')

<div id="data">
<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Booking</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">My Booking</h4></div>

                <div class="card-body" style="min-height: 400px">
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead> 
                                <tr>
                                    <th>Name</th>
                                    <th>Email<i class="fa fa-envelope ml-1"></i></th>
                                    <th>Hostel Name<i class="fa fa-home ml-1"></i></th>
                                    <th>Check in<i class="fa fa-calendar ml-1"></i></th>
                                    <th>Check out<i class="fa fa-calendar ml-1"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>{{Auth::user()->name}}</td>
                                <td>{{Auth::user()->email}}</td>
                                <td>{{$hostelName}}</td>
                                <td>{{$book->first()->check_in}}</td>
                                <td>{{$book->first()->check_out}}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
