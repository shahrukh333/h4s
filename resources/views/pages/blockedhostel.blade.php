@extends('layouts.app')

@section('content')
@include('includes.dsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blocked Hostels</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Blocked Hostels</h4></div>
                <div class="card-body"  style="min-height: 400px;">
                    @if($data != "")
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Hostel Name</th>
                                        <th>City</th>
                                        <th>Owner</th>
                                        <th>Complaints</th>
                                        <th>Blocked at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                {!! $data !!} 
                                </tbody>
                            </table>
                        </div>
                    @else 
                        <div class="pt-5 pb-5 h5 mt-5 text-center font-weight-bold">
                            <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There are no blocked hostels to show
                        </div>
                    @endif
                    <div class="mt-2">
                        <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                        @include('includes.messages')
                    </div>
                    <div class="mt-5"></div>
                </div>
                </div>
            </div>
        </div>
</div>
@endsection
