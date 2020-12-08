@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Hostel Information</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg">
                    <h4 class="text-center text-primary font-weight-bold pt-2">Hostel Information</h4>
                </div>
                    <div class="container mt-3"  style="min-height: 400px;">
                        @if(count($information) > 0)
                           
                           <h4 class="pt-4 pl-4 pb-2 text-info font-weight-bold">General Hostel Informations</h4>
                           <div class="row ml-2">
                               <div class="col-md-6 col-sm-12">
                                    <p>Hostel Name <span class="text-info">{{$information->first()->hostel_name}}</span></p>
                               </div>
                               <div class="col-md-6 col-sm-12">
                                    <p>Phone No <span class="text-info">{{$information->first()->phone_number}}</span></p>
                               </div>
                           </div>

                           <div class="row ml-2">
                                <div class="col-md-6 col-sm-12">
                                    <p>Hostel Category <span class="text-info">{{$information->first()->hostel_category}}</span></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p>Hostel Country <span class="text-info">{{$information->first()->hostel_country}}</span></p>
                                </div>
                           </div>

                           <div class="row ml-2">
                                <div class="col-md-6 col-sm-12">
                                    <p>Hostel Province <span class="text-info">{{$information->first()->hostel_province}}</span></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p>Hostel City <span class="text-info">{{$information->first()->hostel_city}}</span></p>
                                </div>
                           </div>

                           <div class="row ml-2">
                                <div class="col-md-6 col-sm-12">
                                    <p>Hostel Street <span class="text-info">{{$information->first()->hostel_street}}</span></p>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <p>Hostel Address Line <span class="text-info">{{$information->first()->hostel_address_line}}</span></p>
                                </div>
                           </div>

                           <div class="row ml-2 mt-1">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="text-info font-weight-bold">Hostel Description</h4>
                                    {{$information->first()->hostel_description}}
                                </div> 
                           </div>

                           <div class="row ml-2 mt-3">
                                <div class="col-md-12 col-sm-12">
                                    <h4 class="text-info font-weight-bold">Landmarks</h4>
                                    {{$information->first()->landmarks}}
                                </div>
                           </div>

                           <div class="row ml-4 mt-3">
                                <a href="{{ url('editHostelInformation', ['id' => encrypt($information->first()->id)]) }}" class="btn btn-primary mt-1 ml-1">Edit Information<i class="fa fa-pencil fa-lg ml-2"></i></a>
                                <button id="deleteHostelBtn" class="btn btn-primary ml-1 mt-1">Delete Hostel<i class="fa fa-trash fa-lg ml-2"></i></button>
                                <button id="viewHostelImageBtn" class="btn btn-primary ml-1 mt-1">View Images<i class="fa fa-image fa-lg ml-2"></i></button>
                           </div>
                           <div id="deleteHostelAlert" class="row ml-4 mt-2">
                                <div class="alert alert-danger col-md-7" role="alert">
                                    <p>Do you want to delete hostel?</p>
                                    <a class="btn btn-primary" href="{{ url('deleteHostel') }}">Yes</a>
                                    <button id="deleteHostelAlertNoBtn" class="btn btn-primary" id="deleteHostelNoBtn">No</button>
                                </div>
                            </div>
                            <div class="row ml-4 mt-2">
                                @include('includes.messages')
                            </div>
                           <div id="hostelImages">
                            <div class="row mt-4">
                                @if($images != "")
                                    {!!$images!!}
                                @else 
                                    <div class="mt-2 font-weight-bold text-center ml-5 h5">
                                        <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>no image found 
                                    </div>
                                @endif
                            </div>
                            <a class="btn btn-primary mt-2" href="{{ url('editHostelImages') }}">Edit Images<i class="fa fa-pencil fa-lg ml-2"></i></a>
                        </div>
                        
                        @else 
                            <div class="mt-2 font-weight-bold text-center pt-5 pb-5 h5">
                                <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>Hostel information not found
                            </div>
                        @endif
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
   
</script>
