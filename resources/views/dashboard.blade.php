@extends('layouts.app')

@section('content')

@include('includes.dsidenav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 ml-5">
            <div class="card" style="background-color:transparent; border:none">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Dashboard</h4></div>
                <div class="card-body" style="min-height: 450px;">
                    @if(Auth::user()->type == 'A')
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
                            Welcome Sir {{Auth::user()->name}}
                        </div>
                    @else
                        @if($data != "")
                            <h4 class="text-center font-weight-bold text-primary pt-1">Your Registered Hostels</h4>
                            <div class="row">
                                {!! $data !!}
                            </div>
                        @else  <!-- else of hostel not found -->
                            <div class="h5 mt-1 text-center">
                                You have not registered your hostel,
                                <a href="{{ url('hostelRegistration')}}" class="text-primary">register hostel<li class="fa fa-home fa-lg ml-2"></li></a>
                                @if(!session('booking'))
                                    You have no booking, <a href="{{ url('index')}}" class="text-primary">book hostel<li class="fa fa-home fa-lg ml-2"></li></a>
                                @endif
                            </div>         
                        @endif
                        @if($data2 != "")
                            <hr>
                            <h4 class="text-center font-weight-bold text-primary pt-2">Hostels You Are Managing</h4>
                            <div class="row">
                                {!! $data2 !!}
                            </div>
                        @endif
                    @endif
                    <div style="clear:left"></div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection
