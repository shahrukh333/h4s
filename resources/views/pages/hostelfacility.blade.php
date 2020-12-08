@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hostel Facilities</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Facilities</h4></div>
                    <div class="container mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Facilities</th>
                                    <th>Availability</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Wifi</td>
                                    <td>{{$hostelFacilities->first()->wifi}}</td>
                                </tr>
                                <tr>
                                    <td>Mess</td>
                                    <td>{{$hostelFacilities->first()->mess}}</td>
                                </tr>
                                <tr>
                                    <td>TV</td>
                                    <td>{{$hostelFacilities->first()->tv}}</td>
                                </tr>
                                <tr>
                                    <td>CCTV camera</td>
                                    <td>{{$hostelFacilities->first()->cctv_camera}}</td>
                                </tr>
                                <tr>
                                    <td>Laundry</td>
                                    <td>{{$hostelFacilities->first()->laundry}}</td>
                                </tr>
                                <tr>
                                    <td>UPS</td>
                                    <td>{{$hostelFacilities->first()->power_backup}}</td>
                                </tr>
                                <tr>
                                    <td>Daily Clean</td>
                                    <td>{{$hostelFacilities->first()->daily_clean}}</td>
                                </tr>
                                <tr>
                                    <td>Iron</td>
                                    <td>{{$hostelFacilities->first()->iron}}</td>
                                </tr>
                                <tr>
                                    <td>Geyser</td>
                                    <td>{{$hostelFacilities->first()->geyser}}</td>
                                </tr>
                                <tr>
                                    <td>Refrigerator</td>
                                    <td>{{$hostelFacilities->first()->refrigerator}}</td>
                                </tr>
                                @if($hostelFacilities->first()->other_1 != null)
                                    <td>{{$hostelFacilities->first()->other_1}}</td>
                                    <td>Yes</td>
                                @endif
                                @if($hostelFacilities->first()->other_2 != null)
                                    <td>{{$hostelFacilities->first()->other_2}}</td>
                                    <td>Yes</td>
                                @endif
                            </tbody>
                        </table>
                        <a href="{{ url('/editHostelFacilities',['id' => encrypt($hostelFacilities->first()->id)]) }}" class="btn btn-primary h5 mt-3">Edit Facilities<i class="fa fa-pencil fa-lg ml-2"></i></a>
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
