@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Mess Menu</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Mess Menu</h4></div>
                    <div class="container mt-3" style="min-height: 400px;">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Days</th>
                                        <th scope="col">Monday</th>
                                        <th scope="col">Tuesday</th>
                                        <th scope="col">Wednesday</th>
                                        <th scope="col">Thursday</th>
                                        <th scope="col">Friday</th>
                                        <th scope="col">Saturday</th>
                                        <th scope="col">Sunday</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Breakfast</th>
                                        @if($breakfast != null)
                                            <td>{{$breakfast->monday}}</td>
                                            <td>{{$breakfast->tuesday}}</td>
                                            <td>{{$breakfast->wednesday}}</td>
                                            <td>{{$breakfast->thursday}}</td>
                                            <td>{{$breakfast->friday}}</td>
                                            <td>{{$breakfast->saturday}}</td>
                                            <td>{{$breakfast->sunday}}</td>
                                            <td><a href="{{ url('/editBreakfast',['id' => encrypt($breakfast->id)]) }}" class="btn btn-primary">Edit Breakfast Menu<i class="fa fa-pencil fa-lg ml-2"></i></a></td>
                                        @else 
                                            <td colspan="7">breakfast menu not added</td>
                                            <td><a href="{{ url('/addMessMenu') }}" class="btn btn-primary">Add Menu</a></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="row">Lunch</th>
                                        @if($lunch != null)
                                            <td>{{$lunch->monday}}</td>
                                            <td>{{$lunch->tuesday}}</td>
                                            <td>{{$lunch->wednesday}}</td>
                                            <td>{{$lunch->thursday}}</td>
                                            <td>{{$lunch->friday}}</td>
                                            <td>{{$lunch->saturday}}</td>
                                            <td>{{$lunch->sunday}}</td>
                                            <td><a href="{{ url('/editLunch',['id' => encrypt($lunch->id)]) }}" class="btn btn-primary pl-4 pr-4">Edit Lunch Menu<i class="fa fa-pencil fa-lg ml-2"></i></a></td>
                                        @else 
                                            <td colspan="7">lunch menu not added</td>
                                            <td><a href="{{ url('/addMessMenu') }}" class="btn btn-primary">Add Menu<i class="fa fa-edit fa-lg ml-2"></i></a></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <th scope="row">Dinner</th>
                                        @if($dinner != null)
                                            <td>{{$dinner->monday}}</td>
                                            <td>{{$dinner->tuesday}}</td>
                                            <td>{{$dinner->wednesday}}</td>
                                            <td>{{$dinner->thursday}}</td>
                                            <td>{{$dinner->friday}}</td>
                                            <td>{{$dinner->saturday}}</td>
                                            <td>{{$dinner->sunday}}</td>
                                            <td><a href="{{ url('/editDinner',['id' => encrypt($dinner->id)]) }}" class="btn btn-primary pl-3 pr-4">Edit Dinner Menu<i class="fa fa-pencil fa-lg ml-2"></i></a></td>
                                        @else 
                                            <td colspan="7">dinner menu not added</td>
                                            <td><a href="{{ url('/addMessMenu') }}" class="btn btn-primary">Add Menu<i class="fa fa-edit fa-lg ml-2"></i></a></td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-5"></div>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection
