@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hostel Rules</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Rules</h4></div>
                    <div class="container mt-2 p-3" style="min-height: 400px">
                        <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><strong>Rules</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                            @if($hostelRules->first()->rule_1 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_1}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_2 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_2}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_3 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_3}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_4 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_4}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_5 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_5}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_6 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_6}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_7 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_7}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_8 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_8}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_9 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_9}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_10 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_10}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_11 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_11}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_12 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_12}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_13 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_13}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_14 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_14}}</td>
                                </tr>
                            @endif
                            @if($hostelRules->first()->rule_15 != null)
                                <tr>
                                    <td><i class="fa fa-bullhorn mr-1"></i>{{$hostelRules->first()->rule_15}}</td>
                                </tr>
                            @endif
                                    </tbody>
                                </table>
                        <div class="row">
                            <a href="{{ url('/editHostelRules',['id' => encrypt($hostelRules->first()->id)]) }}" class="btn btn-primary ml-3">Edit Rules<i class="fa fa-pencil fa-lg ml-2"></i></a>
                        </div>
                        <div class="mt-5"></div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
