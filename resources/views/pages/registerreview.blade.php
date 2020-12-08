@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Review Hostel</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Register Review</h4></div>
                <div class="container" style="min-height: 400px;">
                    <h5 class="ml-3 mt-4 font-weight-bold">Rate hostel</h5> 
                    <div class="form-group ml-3" id="rating-ability-wrapper">
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
                        <span class="selected-rating font-weight-bold ml-2 h4 mt-4">0</span><span class="font-weight-bold text-primary h5"> Star</span><br>
                        <span id="ratingSpan" class="text-danger"></span>
                    </div>                  
                    <h5 class="ml-3 mt-3 font-weight-bold">Write your review</h5>
                    <div class="container">
                        <div class="form-group">
                            <textarea class="form-control" rows="4" name="review" placeholder="please write you review about the hostel"></textarea>
                            <span id="reviewSpan" class="text-danger"></span>
                        </div>
                        <input type="hidden" value="{{session('hostelId')}}" name="hostelId"/>
                        <input type="hidden" value="{{Auth::user()->id}}" name="userId" />
                        <input type="hidden" value="{{Session::token()}}" name="token"/>
                        <button onclick="registerReview()" class="btn btn-primary">Register Review<i class="fa fa-save fa-lg ml-2"></i></button>
                    </div>
                    <div id="successMessage">
                    </div>
                    <div class="mt-5"></div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- <script>
        /*
         This method stores review into the database
        */
    function registerReview()
    {
        var hostelId = $('input[name = hostelId]').val();
        var userId = $('input[name = userId]').val();
        var review = $('textarea[name = review]').val();
        var token = "{{Session::token()}}";
        var message = '<div class="alert alert-success mt-5" role="alert">review successfully registered</div>';
        
        if(review === '')
        {
            $('#reviewSpan').html('please enter review');
        }
        else 
        {
             $.post("{{ url('registerHostelReview') }}",{review:review, hostelId:hostelId, userId:userId, _token:token}, function(data){
                $('#successMessage').html(message);
             });  
        }
    
    }
    </script> --}}
