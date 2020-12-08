@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{session('hostelName')}}</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">{{session('hostelName')}}</h4></div>
                <div class="card-body" style="min-height: 400px">
                    @if(session('hostel')->status == 'Blocked')
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>Your hostel is blocked, please fix the complaints of the hostellers 
                        </div>
                    @else
                        @if($data != "")
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hosteller Name</th>
                                            <th>Email<i class="fa fa-envelope ml-2"></i></th>
                                            <th>Room No<i class="fa fa-home ml-2"></i></th>
                                            <th>Check in<i class="fa fa-calendar ml-2"></i></th>
                                            <th>Check out<i class="fa fa-calendar ml-2"></i></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    {!! $data !!} 
                                    </tbody>
                                </table> <!-- end of table -->
                            </div>
                        @else 
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There is no hosteller in the hostel 
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
