@extends('layouts.app')

@section('content')
@include('includes.bsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ url('myBooking') }}">My Booking</a></li>
            <li class="breadcrumb-item active" aria-current="page">Register Query</li>
        </ol>
    </nav>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-mybg"><h4 class="text-center text-primary font-weight-bold pt-2">Register Query</h4></div>
                <div class="container" style="min-height: 400px;">                  
                    <h4 class="ml-3 mt-5 font-weight-bold">Register your query</h4>
                    <div class="container">
                        <div class="form-group">
                            <textarea class="form-control" id="que" rows="6" name="query" placeholder="please write you query about the hostel"></textarea>
                            <span id="querySpan" class="text-danger"></span>
                        </div>
                        <input type="hidden" value="{{session('hostelId')}}" name="hostelId"/>
                        <input type="hidden" value="{{Auth::user()->id}}" name="userId" />
                        <input type="hidden" value="{{Session::token()}}" name="token" />
                        <button id="registerQueryBtn" class="btn btn-primary">Register Query<i class="fa fa-save fa-lg ml-2"></i></button>
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

{{-- <script>
        /*
         This method validate the query and send to the controller through ajax request
        */
    function validateQuery()
    {
        var hostelId = $('input[name = hostelId]').val();
        var userId = $('input[name = userId]').val();
        var query = $('textarea[name = query]').val();
        var token = "{{Session::token()}}";
        var message = '<div class="alert alert-success mt-5" role="alert">query is successfully registered, hope soon  you will get a reply</div>';
        
        if(query == '')
        {
            $('#querySpan').html('please enter query');
        }
        else 
        {
             $.post("{{ url('registerHostelQuery') }}",{hostelId:hostelId, userId:userId, query:query, _token:token}, function(data){
                alert(data);
                $('#que').val('');
                $('#successMessage').html(message);
             });  
        }
    
    }
    </script> --}}
