@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item"><a href="{!! url('myReviews') !!}">My Reviews</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hostel Review</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Edit Review</h4></div>
                    <div class="container shadow p-3">
                        <div class="container" style="min-height: 400px">
                            <h5 class="mt-4 font-weight-bold">Rate hostel</h5> 
                            <div class="form-group" id="rating-ability-wrapper">
                                <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
                        
                                <button type="button" class="btnrating btn btn-default" data-attr="1" id="rating-star-1">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default" data-attr="2" id="rating-star-2">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default" data-attr="3" id="rating-star-3">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default" data-attr="4" id="rating-star-4">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                <button type="button" class="btnrating btn btn-default" data-attr="5" id="rating-star-5">
                                    <i class="fa fa-star" aria-hidden="true"></i>
                                </button>
                                    <span class="selected-rating font-weight-bold h5 pl-2 mt-4">0</span><span class="font-weight-bold h5"> Stars</span><br>
                                    <span id="ratingSpan" class="text-danger"></span>
                            </div>
                            <h4 class="pt-3 font-weight-bold">Review</h4>
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="review">{{$review->review}}</textarea>
                                <span class="text-danger" id="reviewSpan"></span>
                            </div>
                            <input type="hidden" value="{{$review->id}}" name="reviewId"/>
                            <input type="hidden" value="{{Session::token()}}" name="token"/>
                            <button onclick="updateReview()" class="btn btn-primary pl-4 pr-4">Update<i class="fa fa-save fa-lg ml-2"></i></button>
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


