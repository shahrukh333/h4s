@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('hostelDuesData') }}">Hosteller Dues</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hosteller Dues</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Hosteller Dues</h4></div>
                    <div class="container mt-3" style="min-height: 400px;">
                        @if($hostellerDues != null)
                            <h4 class="pl-4 mt-3 font-weight-bold">Hosteller Name <span class="text-info">{{$name}}</span></h4>
                            <div class="row ml-3 mt-3">
                                <div class="col-md-4">
                                    <label>Room Rent </label>
                                    <input type="hidden" name="payableDues" value="{{$hostellerDues->payable}}"/>
                                    <span class="text-info">Rs{{$hostellerDues->payable}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label>Pending Balance</label>
                                    <span class="text-info">Rs{{$hostellerDues->pending}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label>Previous Balance </label>
                                    <input type="hidden" name="duesId" value="{{$hostellerDues->id}}"/>
                                    <input type="hidden" name="token" value="{{Session::token()}}"/>
                                    <input type="hidden" name="previousDues" value="{{$hostellerDues->previous_balance}}"/>
                                    <span class="text-info">Rs{{$hostellerDues->previous_balance}}</span>
                                </div>
                            </div>
                            <div class="row mt-3 ml-3">
                                <div class="col-md-6">
                                    <label>Amount Paid</label>
                                    <input name="paidDues" class="form-control" type="number" placeholder="enter amount paid"/>
                                    <span class="text-danger" id="amountPaid"></span>
                                </div>
                            </div>
                            <div class="row ml-3 mt-4">
                                <div class="col-md-6">
                                    <span class="text-info" id="paidAmount"></span>
                                    <span class="text-info" id="dues"></span>
                                    <span class="text-info" id="previousAmount"></span>
                                    <span class="text-info" id="returnAmount"></span><br>
                                    <button class="btn btn-primary" id="duesCalculateBtn">Calculate Dues<i class="fa fa-calculator fa-lg ml-2"></i></button>
                                    <button class="btn btn-primary pl-5 pr-5" id="duesSaveBtn">Save<i class="fa fa-save fa-lg ml-2"></i></button>
                                    <button class="btn btn-primary pl-5 pr-5" id="duesSave2Btn">save2</button>
                                    <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                                </div>
                            </div>
                            <div class="row ml-3 mt-4">
                                <div id="payableAmountLessDiv" class="alert alert-danger col-md-10" role="alert">
                                    <p>As the paid amount is less than the payable amount, so we are adding the 
                                    remaining amount to the previous balance</p>
                                </div>
                                <div id="payableAmountMoreDiv" class="alert alert-danger col-md-10" role="alert">
                                    <p>Do you want to adjust the previous balance?</p><br>
                                    <button class="btn btn-primary pl-4 pr-4" id="EditDuesYesBtn">Yes</button>
                                    <button class="btn btn-primary pl-4 pr-4" id="EditDuesNoBtn">No</button>
                                </div>
                                <div id="success" class="col-md-8"></div>
                            </div>
                            @if($hostellerDues->previous_balance > 0)
                                <form action="{{url('adjustPreviousBalance')}}" method="POST">
                                    @csrf
                                    <h4 class="font-weight-bold pl-4">Adjust Previous balance</h4>
                                    <div class="row ml-3 mt-4">
                                        <div class="col-md-12">
                                            <input type="number" name="previousMoney" class="form-control col-md-6" placeholder="enter amout">
                                            <input type="hidden" name="duesId" value="{{$hostellerDues->id}}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary mt-4">Adjust Previous Balance<i class="fa fa-calculator fa-lg ml-2"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mt-2">
                                    @include('includes.messages')
                                </div>
                            @endif
                        @endif
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

