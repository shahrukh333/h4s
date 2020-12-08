@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('hostelInformation') }}">Hostel Information</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hostel information</li>
        </ol>
    </nav>
</div>

<div class="container">
<div class="row justify-content-center">
    <div class="col-md-12" style="min-height: 400px">
        <div class="card" >
            <div class="bg-mybg">
                <h4 class="text-center text-primary font-weight-bold pt-2">Edit Hostel Information</h4>
            </div>
            <div class="mt-3" id="hostelInformation" style="margin-left: 10%;">
                <h4 class="text-info font-weight-bold">Hostel Information</h4>
                <div class="row">
                    <div class="col-md-5">
                        <label>Hostel Name</label>
                        <input name="hostelName" class="form-control" value="{{$information->hostel_name}}" placeholder="Hostel Name"/>
                        <span class="text-danger" id="hostelNameSpan"></span>
                    </div>
                    <div class="col-md-5">
                        <label>Mobile (10 digit)</label>
                        <input name="phoneNumber" class="form-control" value="{{$information->phone_number}}" type="number" maxlength="10" placeholder="Ex. 03001234567 (10 digit number)"/>
                        <span class="text-danger" id="phoneNoSpan"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label class="mt-2">Hostel Category</label>
                        <select class="form-control" name="hostelCategory">
                            <option value="{{$information->hostel_category}}" selected="selected">{{$information->hostel_category}}</option>
                            <option value="Male Hostel">Male Hostel</option>
                            <option value="Female Hostel">Female Hostel</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label class="mt-2">Country</label>
                        <select class="form-control" name="hostelCountry">
                            <option value="{{$information->hostel_country}}" selected="selected">{{$information->hostel_country}}</option>
                            <option value="Pakistan">Pakistan</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label class="mt-2">Province</label>
                        <select class="form-control" name="hostelProvince">
                            <option value="{{$information->hostel_province}}" selected="selected">{{$information->hostel_province}}</option>
                            <option value="Punjab">Punjab</option>
                        </select>
                    </div>
                    
                    <div class="col-md-5">
                        <label class="mt-2">City</label>
                        <select class="form-control" name="hostelCity">
                            <option value="{{$information->hostel_city}}" selected="selected">{{$information->hostel_city}}</option>
                            <option value="Islamabad">Islamabad</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5">
                        <label class="mt-2">Street address</label>
                        <input name="streetAddress" value="{{$information->hostel_street}}" class="form-control" type="text" placeholder="e.g. 123 Easy Street" />
                        <span class="text-danger" id="streetSpan"></span>
                    </div>
                    
                    <div class="col-md-5">
                        <label class="mt-2">Address Line 2</label>
                        <input name="addressLine" value="{{$information->hostel_address_line}}" class="form-control" type="text" placeholder="Unit number, suite, floor, building, etc. "/>
                        <span class="text-danger" id="addressLineSpan"></span>
                    </div>
                </div>
                <button id="editHostelInformationNextBtn" class="btn btn-primary mt-3 pl-4 pr-4">Next<i class="fa fa-angle-double-right fa-lg ml-2"></i></button>
            </div>

            <div class="mt-2" id="hostelInformation2" style="margin-left: 10%">
                <h4 class="text-info font-weight-bold">Hostel Information</h4>
                <div class="row">
                    <div class="col-md-5 mt-3">
                        <label>Hostel Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3">
                            {{$information->hostel_description}}
                        </textarea>
                        <span class="text-danger" id="descriptionSpan"><span>
                    </div>
                    <div class="col-md-5 mt-3">
                        <label>Land Mark</label>
                        <textarea class="form-control" name="landmark" id="landmark" rows="3" placeholder="Ex. Near Hi-tech theater">
                            {{$information->landmarks}}
                        </textarea>
                        <span class="text-danger" id="landmarkSpan"><span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mt-3">
                        <label>Estimate rent </label>
                        <input name="estimateRent" value="{{$information->hostel_rent}}" class="form-control" type="number" placeholder="10000 rupees"/>
                        <span class="text-danger" id="estimateRentSpan"><span>
                    </div>
                    <div class="col-md-5 mt-3">
                        <label>Rent period </label>
                        <select class="form-control" name="rentPeriod">
                            <option value="{{$information->rent_period}}" selected="selected">{{$information->rent_period}}</option>
                            <option value="Year">Year</option>
                            <option value="Month">Month</option>
                            <option value="Week">Week</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" value="{{Session::token()}}" name="token" />
                <input type="hidden" value="{{$information->id}}" name="informationId" />
                <button id="editHostelInformationBackBtn" class="btn btn-primary mt-3 pl-4 pr-4"><i class="fa fa-angle-double-left fa-lg mr-2"></i>Back</button>
                <button id="editHostelInformationUpdateBtn" class="btn btn-primary mt-3 pl-4 pr-4">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                <div id="success" class="col-md-10"></div>
            </div>
            <div class="mt-5"></div>
        </div>
    </div>
    </div>          
</div>
@endsection
