@extends('layouts.app')

@section('content')

@include('includes.dsidenav')

<div class="container mybreadcrumb">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrow">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
        </ol>
    </nav>
</div>


<div class="container" onload="hideFields()">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="bg-mybg pt-2">
                    <h4 class="text-center font-weight-bold text-primary">Edit Profile</h4>
                </div>
                <div class="card-body" style="min-height: 400px;">
                    <div class="container" style="margin-left: 15%">
                        <div class="form-group row">
                            <img style="margin-left: 24%" src="{{ url('graphics/editprofile.png')}}" alt="image not found" width="100" height="100">
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-8">
                                <label><h4 class="text-info">Change Username</h4></label><br>
                                <label><h6>User Name <i class="fa fa-arrow-right mr-1"></i><span class="text-primary">{{Auth::user()->name}}</span></h6></label><br/>
                                <input type="text" id="username" name="username" class="form-control" placeholder="enter new username" required/> 
                                <span id="usernameSpan" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-8">
                                <button onclick="validateUserName()" class="btn btn-primary mt-2">Update Username<i class="fa fa-save fa-lg ml-2"></i></button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8">
                                <label><h4 class="text-info">Change password</h4></label><br>
                                <label>New Password<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input type="password" id="pass" name="password" class="form-control" placeholder="enter new password" required/>
                                <span id="passwordSpan" class="text-danger"></span><br>  
                                <label for="confirmPassword" class="mt-2">Confirm Password<i class="fa fa-unlock-alt fa-lg ml-2"></i></label>
                                <input type="password" id="conPass" name="confirmPassword" class="form-control" placeholder="confirm password" required/>
                                <span id="confirmPasswordSpan" class="text-danger"></span><br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <button onclick="validatePassword()" class="btn btn-primary">Update Password<i class="fa fa-save fa-lg ml-2"></i></button> 
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-6">
                                <button id="deleteAccountBtn" class="btn btn-primary pl-4 pr-3 mt-3">Delete Account<i class="fa fa-trash fa-lg ml-2"></i></button> 
                            </div>
                        </div>
                        <div id="deleteAccountAlert" class="form-group row">
                            <div class="col-md-8">
                                <div class="alert alert-danger" role="alert">
                                    <p>Are you sure you want to delete your account?</p>
                                    <a href="{{ url('deleteAccount')}}" id="deleteAccountYesBtn" class="btn btn-primary pl-4 pr-4">Yes</a>
                                    <button id="deleteAccountNoBtn" class="btn btn-primary pl-4 pr-4">No</button>
                                </div>
                            </div>
                        </div>
                        <img id="myLoader" class="ml-2" src="{{ url('graphics/loader2.gif') }}" width="40" height="40"/>
                        <div class="form-group row">
                            <div class="col-md-10">
                                @include('includes.messages')
                            </div>
                        </div>
                        <div id="success"></div>
                    </div>
                    <div class="mt-5"></div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
function validateUserName()
{
    $('#deleteAccountAlert').hide();
    var message = '<div class="alert alert-danger mt-5" role="alert">username updated successfully</div>';
    var name = $('input[name = username]').val();
    var token = "{{Session::token()}}";
    var error = false;

    if(name == '')
    {
        $('#usernameSpan').html('please enter user name');
        error = true;
    }

    if(error == false)
    {
        $.post("{{ url('/updateUsername') }}",{name:name, _token:token}, function(data){
            $('#username').val('');
            $('#success').html(message);
         });
    }
    
}

function validatePassword()
{
    $('#deleteAccountAlert').hide();
    var message = '<div class="alert alert-danger mt-5" role="alert">password updated successfully</div>';
    var password = $('input[name = password]').val();
    var confirmPassword = $('input[name = confirmPassword').val();
    var token = "{{Session::token()}}";
    var error = false;

    if(password == '')
    {
        $('#passwordSpan').html('please enter password');
        error = true;
    }
    else
    {
        $('#passwordSpan').html('');
    }

    if(confirmPassword == '')
    {
        $('#confirmPasswordSpan').html('please enter confirm password');
        error = true;
    }
    else 
    {
        $('#confirmPasswordSpan').html('');
    }

    if(!error)
    {
        if(password != confirmPassword)
        {
            $('#confirmPasswordSpan').html('passwords donot match');
            error = true;
        }
    }

    if(!error)
    {
        $.post("{{ url('/updatePassword') }}",{password:password, _token:token}, function(data){
            $('#pass').val('');
            $('#conPass').val('');
            $('#success').html(message);
         });
    }

}
</script>
