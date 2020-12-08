@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Hostel Rules</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="max-width: 85.667%;">
            <div class="card">
                <div class="card-header"><h3 class="text-center">Hostel Rules</h3></div>
                    <div class="container mt-5 shadow p-3">
                        <table class="table shadow">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Rules</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$hostelRules->regulation}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
