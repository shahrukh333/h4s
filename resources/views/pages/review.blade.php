@extends('layouts.app')

@section('content')
@include('includes.sidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myHostel', ['id' => encrypt(session('hostel')->id)]) }}">{{session('hostelName')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reviews</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Reviews</h4></div>
                <div class="card-body" style="min-height: 400px;">
                    @if(count($reviews) > 0)
                        <h6 class="text-danger pl-3">Until you won't click on Mark as read, reviews will appear every time</h6>
                        @if(count($reviews) > 1)
                            @foreach($reviews as $review)
                                <div class="container p-3">
                                    <div class="well mt-2">
                                        <h5 class="font-weight-bold">Hosteller: <span class="text-primary">{{$user->getUserName($review->hosteller_id)}}</span></h5>
                                        <h5 class="font-weight-bold">Rating</h5>
                                        <div>
                                            @if($review->rating == 1)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            @endif
                                            @if($review->rating == 2)
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x"></li>
                                                <li class="fa fa-star fa-2x"></li>
                                                <li class="fa fa-star fa-2x"></li>
                                            @endif
                                            @if($review->rating == 3)
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x"></li>
                                                <li class="fa fa-star fa-2x"></li>
                                            @endif
                                            @if($review->rating == 4)
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x text-warning"></li>
                                                <li class="fa fa-star fa-2x"></li>
                                            @endif
                                            @if($review->rating == 5)
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
                                            <a href="{{route('updateReviewStatus', ['id' => encrypt($review->id)])}}" class="btn btn-primary">Mark Read<i class="fa fa-check fa-lg ml-2"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @else 
                            <div class="container p-3">
                                <div class="well mt-2">
                                    <h5 class="font-weight-bold">Hosteller: <span class="text-primary">{{$user->getUserName($reviews->first()->hosteller_id)}}</span></h5>
                                    <h5 class="font-weight-bold">Rating</h5>
                                    <div>
                                        @if($reviews->first()->rating == 1)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @endif
                                        @if($reviews->first()->rating == 2)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @endif
                                        @if($reviews->first()->rating == 3)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @endif
                                        @if($reviews->first()->rating == 4)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x"></li>
                                        @endif
                                        @if($reviews->first()->rating == 5)
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                            <li class="fa fa-star fa-2x text-warning"></li>
                                        @endif
                                        <span class="h5 font-weight-bold ml-2 mt-2">{{$reviews->first()->rating}} Stars</span>
                                    </div>
                                    <div class="mt-2"> 
                                        <h5 class="font-weight-bold">Review</h5>
                                        <p><span class="font-weight-bold">Review:</span> {{$reviews->first()->review}}</p>
                                        <p class="mt-2"><span class="font-weight-bold">Review time:</span> {{$reviews->first()->created_at}}</p>
                                        <a href="{{route('updateReviewStatus', ['id' => encrypt($reviews->first()->id)])}}" class="btn btn-primary">Mark Read<i class="fa fa-check fa-lg ml-2"></i></a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div class="row col-md-12 col-sm-12 ml-1">
                            {!! $reviews->appends(Request::all())->render()!!}
                        </div>
                    @else 
                        <div class="mt-5 text-center font-weight-bold pt-5 pb-5 h5">
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
