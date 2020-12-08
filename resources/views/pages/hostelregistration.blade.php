@extends('layouts.app')
@section('content')
@include('includes.dsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register Hostel</li>
        </ol>
    </nav>
</div>

 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="min-height: 400px">
            <div class="card" >
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Hostel Registration</h4></div>
                <form action="{{ url('registerHostel')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mt-4" id="hostelInformation" style="margin-left: 10%;">
                    <h5 class="text-info font-weight-bold ml-3">Hostel Information</h5>
                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <label>Hostel Name</label>
                            <input name="hostelName" class="form-control" placeholder="Hostel Name"/>
                            <span class="text-danger" id="hostelNameSpan"></span>
                        </div>
                        <div class="col-md-5">
                            <label>Mobile (11 digit)</label>
                            <input name="phoneNumber" class="form-control" type="number" maxlength="11" placeholder="Ex. 03001234567 (11 digit number)"/>
                            <span class="text-danger" id="phoneNoSpan"></span>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <label class="mt-2">Hostel Category</label>
                            <select class="form-control" name="hostelCategory">
                                <option value="Male Hostel">Male Hostel</option>
                                <option value="Female Hostel">Female Hostel</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="mt-2">Country</label>
                            <select class="form-control" name="hostelCountry">
                                <option value="Pakistan">Pakistan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <label class="mt-2">Province</label>
                            <select class="form-control" name="hostelProvince" onchange="provinceChange()" id="provinceSelect">
                                <option value="Punjab">Punjab</option>
                                <option value="Punjab">KPK</option>
                            </select>
                        </div>
                        
                        <div class="col-md-5">
                            <label class="mt-2">City</label>
                            <select class="form-control" name="hostelCity">
                                <option value="Islamabad">Islamabad</option>
                                <option value="Rawalpindi">Rawalpindi</option>
                                <option value="Lahore">Lahore</option>
                                <option value="Faisalabad">Faisalabad</option>
                                <option value="Attock">Attock</option>
                                <option value="Attock">Peshawar</option>
                            </select>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="col-md-5">
                            <label class="mt-2">Street address</label>
                            <input name="streetAddress" class="form-control" type="text" placeholder="e.g. 123 Easy Street" />
                            <span class="text-danger" id="streetSpan"></span>
                        </div>
                        
                        <div class="col-md-5">
                            <label class="mt-2">Address Line 2</label>
                            <input name="addressLine" class="form-control" type="text" placeholder="Unit number, suite, floor, building, etc. "/>
                            <span class="text-danger" id="addressLineSpan"></span>
                        </div>
                    </div>
                    <div class="row col-md-12">
                        <button type="button" id="hostelInformationNextBtn" class="btn btn-primary ml-3 mt-3 pl-4 pr-4">Next<i class="fa fa-angle-double-right fa-lg ml-2"></i></button>
                    </div>
                </div> 
                <!-- end of hostel information -->
                

                <!-- Hostel Facilities -->
                <div class="mt-4" id="hostelFacilities" style="margin-left: 10%">
                    <h5 class="text-info font-weight-bold ml-3">Hostel Information<i class="fa fa-angle-right fa-lg ml-2 mr-2"></i>Hostel Facilities</h5>
                                        
                    <div class="row col-md-12 mt-3">            
                        <div class="col-md-2">                           
                            <label>WiFi</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="wifi">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>
                    
                        <div class="col-md-2">                         
                            <label>Mess</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="mess">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>                     
                    </div>
                                            
                    
                    <div class="row col-md-12 mt-3">       
                        <div class="col-md-2">                           
                            <label>TV</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="tv">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>
                        <div class="col-md-2">                         
                            <label>CCTV camera </label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="cctvCamera">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>                       
                    </div>
                                            
                    
                    <div class="row col-md-12 mt-3">             
                        <div class="col-md-2">                           
                            <label>Laundry</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="laundry">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>
                        <div class="col-md-2">                         
                            <label>Power Backup</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="powerBackup">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>                      
                    </div>
                    
                    <div class="row col-md-12 mt-3">
                                                
                        <div class="col-md-2">                           
                            <label>Daily Clean</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="dailyClean">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>
                        <div class="col-md-2">                         
                            <label>Electric Iron</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="iron">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>                         
                    </div>
                                        
                    
                    <div class="row col-md-12 mt-3">      
                        <div class="col-md-2">                           
                            <label>Geyser</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="geyser">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>
                        <div class="col-md-2">                         
                            <label>Refrigerator </label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="refrigerator">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>                         
                    </div>
                    <div class="row col-md-12 mt-3">      
                        <div class="col-md-2">                           
                            <label>Parking</label>
                        </div>
                        <div class="col-md-3">                          
                            <select class="form-control" name="parking">
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>                            
                        </div>                         
                    </div>
                                            
                    <div class="row col-md-12 mt-3">                       
                        <div class="col-md-2">                           
                            <label>Other*</label>
                        </div>
                        <div class="col-md-3">                          
                            <input name="other1" class="form-control" type="text" placeholder="enter..." />                            
                        </div>
                        
                        <div class="col-md-2">                          
                            <label>Other*</label>
                        </div>
                        <div class="col-md-3">                          
                            <input name="other2" class="form-control" type="text" placeholder="enter..." />                            
                        </div>                          
                    </div>
                    <p class="text-primary ml-3 mt-2">*Additional facility other than that mentioned above</p>
                    <button type="button" id="hostelFacilitiesBackBtn" class="btn btn-primary ml-3 mt-2 pl-4 pr-4"><i class="fa fa-angle-double-left fa-lg mr-2"></i>Back</button>
                    <button type="button" id="hostelFacilitiesNextBtn" class="btn btn-primary mt-2 pl-4 pr-4">Next<i class="fa fa-angle-double-right fa-lg ml-2"></i></button>
                </div> 
                <!-- end of hostel facilities -->

                <!-- start of hostel information final -->
                <div class="mt-4" id="hostelInformation2" style="margin-left: 10%">

                    <h5 class="text-info font-weight-bold ml-3 mt-3">Hostel Information<i class="fa fa-angle-right fa-lg ml-2 mr-2"></i>Hostel Facilities<i class="fa fa-angle-right fa-lg ml-2 mr-2"></i>Extra Information</h5>
                    <div class="row col-md-12">
                        <div class="col-md-5 mt-3">
                            <label>Hostel Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Ex. we are providing.."></textarea>
                            <span class="text-danger" id="descriptionSpan"><span>
                        </div>
                        <div class="col-md-5 mt-3">
                            <label>Land Mark</label>
                            <textarea class="form-control" name="landmark" id="landmark" rows="3" placeholder="Ex. Near Hi-tech theater"></textarea>
                            <span class="text-danger" id="landmarkSpan"><span>
                        </div>
                    </div>

                    <div class="row col-md-12">
                        <div class="col-md-5 mt-3">
                            <label>Estimate rent </label>
                            <input name="estimateRent" class="form-control" type="number" placeholder="10000 rupees"/>
                            <span class="text-danger" id="estimateRentSpan"><span>
                        </div>
                        <div class="col-md-5 mt-3">
                            <label>Rent period </label>
                            <select class="form-control" name="rentPeriod">
                                <option value="Year">Year</option>
                                <option value="Month">Month</option>
                                <option value="Week">Week</option>
                            </select>
                        </div>
                    </div>

                    <h5 class="text-info ml-3 pt-3">Please select hostel images</h5>
                    <div class="row col-md-12 mt-3">
                        <div class="col-md-5">
                            <label>First Image</label>
                            <input type="file" class="form-control" name="image1"/>
                            <span id="image1Span" class="text-danger"></span>
                        </div>
                        <div class="col-md-5">
                            <label>Second Image</label>
                            <input type="file" class="form-control" name="image2"/>
                            <span id="image2Span" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row col-md-12 mt-3">
                        <div class="col-md-5">
                            <label>Third Image</label>
                            <input type="file" class="form-control" name="image3"/>
                            <span id="image3Span" class="text-danger"></span>
                        </div>
                        <div class="col-md-5">
                            <label>Fourth Image</label>
                            <input type="file" class="form-control" name="image4"/>
                            <span id="image4Span" class="text-danger"></span>
                        </div>
                    </div>

                    <input type="hidden" value="{{Session::token()}}" name="token" />
                    <button type="button" id="hostelInformation2BackBtn" class="btn btn-primary ml-3 mt-3 pl-4 pr-4"><i class="fa fa-angle-double-left fa-lg mr-2"></i>Back</button>
                    <button type="button" id="hostelInformation2SaveBtn" class="btn btn-primary mt-3 pl-4 pr-4">Next<i class="fa fa-angle-double-right fa-lg ml-2"></i></button>
                    <button type="submit" id="saveBtn" class="btn btn-primary mt-3 pl-4 pr-4">Register<i class="fa fa-save fa-lg ml-2"></i></button>
                    <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                    
                </div>
                </form>
                <div class="mt-5"></div>
            </div>
        </div>
    </div>
</div> 
@endsection
