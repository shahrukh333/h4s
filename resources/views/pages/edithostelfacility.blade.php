@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('getHostelFacilities') }}">HostelFacilities</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hostel Facilities</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Hostel Facilities</h4></div> 
                    <div class="container">
                    <h5 class="text-info pl-3">Hostel Facilities</h5>
                        <div class="container">                                
                        <div class="row mt-3">            
                            <div class="col-md-3">                           
                                <label>WiFi</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="wifi">
                                    <option value="{{$facilities->wifi}}" selected ="selected">{{$facilities->wifi}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>
                        
                            <div class="col-md-3">                         
                                <label>Mess</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="mess">
                                    <option value="{{$facilities->mess}}" selected ="selected">{{$facilities->mess}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>                     
                        </div>
                                                
                        <div class="row mt-3">       
                            <div class="col-md-3">                           
                                <label>TV</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="tv">
                                    <option value="{{$facilities->tv}}" selected ="selected">{{$facilities->tv}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>
                            <div class="col-md-3">                         
                                <label>CCTV camera </label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="cctvCamera">
                                    <option value="{{$facilities->cctv_camera}}" selected ="selected">{{$facilities->cctv_camera}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>                       
                        </div>                      
                        
                        <div class="row mt-3">             
                            <div class="col-md-3">                           
                                <label>Laundry</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="laundry">
                                    <option value="{{$facilities->laundry}}" selected ="selected">{{$facilities->laundry}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>
                            <div class="col-md-3">                         
                                <label>Power Backup</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="powerBackup">
                                    <option value="{{$facilities->power_backup}}" selected ="selected">{{$facilities->power_backup}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>                      
                        </div>
                        
                        <div class="row mt-3">
                                                    
                            <div class="col-md-3">                           
                                <label>Daily Clean</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="dailyClean">
                                    <option value="{{$facilities->daily_clean}}" selected ="selected">{{$facilities->daily_clean}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>
                            <div class="col-md-3">                         
                                <label>Electric Iron</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="iron">
                                    <option value="{{$facilities->iron}}" selected ="selected">{{$facilities->iron}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>                         
                        </div>
                        
                        <div class="row mt-3">      
                            <div class="col-md-3">                           
                                <label>Geyser</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="geyser">
                                    <option value="{{$facilities->geyser}}" selected ="selected">{{$facilities->geyser}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>
                            <div class="col-md-3">                         
                                <label>Refrigerator </label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="refrigerator">
                                    <option value="{{$facilities->refrigerator}}" selected ="selected">{{$facilities->refrigerator}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>                         
                        </div>

                        <div class="row mt-3">      
                            <div class="col-md-3">                           
                                <label>Parking</label>
                            </div>
                            <div class="col-md-3">                          
                                <select class="form-control" name="parking">
                                    <option value="{{$facilities->parking}}" selected ="selected">{{$facilities->parking}}</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>                            
                            </div>                         
                        </div>
                                                
                        <div class="row mt-3">                       
                            <div class="col-md-3">                           
                                <label>Other1*</label>
                            </div>
                            <div class="col-md-3">                          
                                <input name="other1" class="form-control" value="{{$facilities->other_1}}" type="text" placeholder="enter..." />                            
                            </div>
                            
                            <div class="col-md-3">                          
                                <label>Other2*</label>
                            </div>
                            <div class="col-md-3">                          
                                <input name="other2" class="form-control" value="{{$facilities->other_2}}" type="text" placeholder="enter..." />                            
                            </div>
                            <input type="hidden" name="token" value="{{Session::token()}}" /> 
                            <input type="hidden" name="facilityId" value="{{$facilities->id}}" />                         
                        </div>
                        <p class="text-primary mt-2">*Additional facility other than that mentioned above</p>
                        <button id="hostelFacilityBtn" class="btn btn-primary mt-2 pl-4 pr-4">Update<i class="fa fa-save fa-lg ml-2"></i></button>
                        </div>
                        <div id="success"></div>
                        <div class="mt-5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


