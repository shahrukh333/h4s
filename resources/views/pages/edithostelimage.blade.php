@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ url('hostelInformation') }}">Hostel Information</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hostel Images</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg">
                    <h4 class="text-center text-primary font-weight-bold pt-2">Edit Hostel Images</h4>
                </div>
                    <div class="container mt-3" style="min-height: 400px">
                        <div class="row mt-4">
                            @if($images != "")
                                {!!$images!!}
                            @else 
                                <div class="mt-2 font-weight-bold text-center ml-3 h5">
                                    <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>No image found 
                                </div>
                            @endif
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary mt-2" id="addHostelImageBtn">Add New Image<i class="fa fa-image fa-lg ml-2"></i></button>
                            @if($imageAdded)
                                <div class="aler alert danger" role="alert">
                                    hostel image added
                                </div>
                            @endif
                        </div>
                        <div id="addHostelImageForm" class="mt-3">
                            <form action="{{ url('addHostelImage')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="hostelImage" class="form-control">
                                <input type="hidden" name="hostelId" value="{{$hostelId}}">
                                <span id="addHostelImageSpan" class="text-danger"></span><br>
                                <button type="button" id="validateHostelImageBtn" class="btn btn-primary mt-1">Next<i class="fa fa-angle-double-right fa-lg ml-2"></i></button>
                                <button type="submit" id="submitHostelImageBtn" class="btn btn-primary mt-1">Save<i class="fa fa-save fa-lg ml-2"></i></button>
                            </form>
                        </div>
                        <div class="mt-5"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
   
</script>
