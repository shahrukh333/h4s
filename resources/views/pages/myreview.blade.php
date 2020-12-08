@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Reviews</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">My Reviews</h4></div>
                <div class="card-body" style="min-height: 400px;">
                @if(count($reviews) > 0)
                    @if(count($reviews) > 1)
                        @foreach($reviews as $review)
                            <div class="container p-3">
                                <h4 class="text-primary font-weight-bold">{{$info->getHostelInformation($review->hostel_id)->first()->hostel_name}}</h4>
                                <div class="well mt-3">
                                    <h5 class="font-weight-bold">Rating</h5>
                                    <div>
                                        @if($review->rating == 1)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @elseif($review->rating == 2)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @elseif($review->rating == 3)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @elseif($review->rating == 4)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @elseif($review->rating == 5)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                        @endif
                                        <span class="h5 font-weight-bold ml-2 mt-2">{{$review->rating}} Stars</span>
                                    </div>
                                    <div class="mt-2"> 
                                        <h5 class="font-weight-bold">Review</h5>
                                        <p><span class="font-weight-bold">Review:</span> {{$review->review}}</p>
                                        <p class="mt-2"><span class="font-weight-bold">Review time:</span> {{$review->created_at}}</p>
                                        <a href="{{ url('/editReview',['id' => encrypt($review->id)]) }}" class="btn btn-primary">Edit<i class="fa fa-pencil fa-lg ml-2"></i></a>
                                        <a href="{{ url('/deleteMyReview',['id' => encrypt($review->id)]) }}" class="btn btn-primary">Delete<i class="fa fa-trash fa-lg ml-2"></i></a>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
                    @else 
                        <div class="container p-3">
                            <div class="well mt-3">
                                <h5 class="font-weight-bold">Rating</h5>
                                <div>
                                    @if($reviews->first()->rating == 1)
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                    @elseif($reviews->first()->rating == 2)
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                    @elseif($reviews->first()->rating == 3)
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                    @elseif($reviews->first()->rating == 4)
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x"></li>
                                    @elseif($reviews->first()->rating == 5)
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                        <li class="fa fa-star fa-2x text-warning"></li>
                                    @endif
                                    <span class="h3 font-weight-bold ml-2 mt-2">{{$reviews->first()->rating}} Stars</span>
                                </div>
                                <div class="mt-2"> 
                                    <h5 class="font-weight-bold">Review</h5>
                                    <p><span class="font-weight-bold">Review:</span> {{$reviews->first()->review}}</p>
                                    <p class="mt-2"><span class="font-weight-bold">Review time:</span> {{$reviews->first()->created_at}}</p>
                                    <a href="{{ url('/editReview',['id' => encrypt($reviews->first()->id)]) }}" class="btn btn-primary">Edit<i class="fa fa-pencil fa-lg ml-2"></i></a>
                                    <a href="{{ url('/deleteMyReview',['id' => encrypt($reviews->first()->id)]) }}" class="btn btn-primary">Delete<i class="fa fa-trash fa-lg ml-2"></i></a>
                                </div>
                            </div>
                            <hr>
                        </div>
                    @endif
                @else  
                    <div class="mt-5 font-weight-bold text-center pt-5 pb-5 h5">
                        <li class="fa fa-exclamation-circle fa-lg text-primary mr-1"></li>There are no reviews to show
                    </div>
                @endif
                <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
